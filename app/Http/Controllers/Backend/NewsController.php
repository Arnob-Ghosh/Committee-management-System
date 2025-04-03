<?php

namespace App\Http\Controllers\Backend;

use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    public function create(){
        // $subscribers = Subscriber::all();
        $categories= Category::all();
        return view('backend/news/news-add',compact('categories'));
    }

    public function store(Request $req){

        $messages = [
            'news_title.required'  =>    "News title is required.",
            'news_thumbnail.required'  =>   "News thumbnail is required.",

            'news_category.required' =>    "News Category is required.",
        ];

        $validator = Validator::make($req->all(), [
            'news_title' => 'required',


            'news_thumbnail'=> 'required',
            'news_category' =>   'required',
        ], $messages);

        if ($validator->passes()) {
            $news = new News;

            $news->news_title                        = $req->news_title;
            $news->news_description                 = $req->news_description;

            $news->news_category                 = $req->news_category;
            $news->accession_number                 = $req->accession_number;
            $news->highlight                 = $req->highlight;


            $file = $req->file('news_image');
            $extension = $file->getClientOriginalExtension();
            $filename = hexdec(uniqid())  . '.' . $extension;
            $save_path='uploads/news/image';

            $news_thumbnail_file = $req->file('news_thumbnail');
            $news_thumbnail_extension = $file->getClientOriginalExtension();
            $news_thumbnail_filename = hexdec(uniqid())  . '.' . $news_thumbnail_extension;
            $news_thumbnail_save_path='uploads/news/image/thumbnail/';
            if (!file_exists($news_thumbnail_save_path)) {
                // mkdir($save_path, 666, true);


                Image::make($news_thumbnail_file)->save(public_path(  $news_thumbnail_save_path. $news_thumbnail_filename));
                // $file->move('uploads/sliderimage/', $news_thumbnail_filename);
                $save_url = 'uploads/news/image/thumbnail/' . $news_thumbnail_filename;

                $news->news_thumbnail  = $save_url;
            }
            else{
                Image::make($news_thumbnail_file)->save(public_path(  $news_thumbnail_save_path. $news_thumbnail_filename));
                // $file->move('uploads/news/image', $news_thumbnail_filename);
                $save_url = 'uploads/news/image/thumbnail/' . $news_thumbnail_filename;

                $news->news_thumbnail  = $save_url;

            }

            if (!file_exists($save_path)) {
                // mkdir($save_path, 666, true);


                Image::make($file)->save(public_path(  $save_path. $filename));
                // $file->move('uploads/sliderimage/', $filename);
                $save_url = 'uploads/news/image' . $filename;

                $news->news_image  = $save_url;
            }
            else{
                Image::make($file)->save(public_path(  $save_path. $filename));
                // $file->move('uploads/news/image', $filename);
                $save_url = 'uploads/news/image' . $filename;

                $news->news_image  = $save_url;

            }


            $news->save();

            return response() -> json([
                'status'=>200,
                'message' => 'News created successfully!'
            ]);

        }

        return response()->json(['error'=>$validator->errors()]);

    }

    public function list(){
        return view('backend/news/news-list');
    }

    public function listData(Request $request){

        $news = News::all();

        if($request -> ajax()){
            return response()->json([
                'news'=>$news,
            ]);
        }


    }

    public function edit($id){
        $news = News::find($id);
        $categories=Category::get();
        return view('backend/news/news-edit',compact('news','categories'));

        // if($category){
        //     return response()->json([
        //         'status'=>200,
        //         'category'=>$category,

        //     ]);
        // }
    }

    public function update(Request $req, $id){

        $messages = [
            'news_title.required'  =>    "News title is required.",
            // 'news_image.required'  =>    "Image is required.",
            'news_description.required'  =>    "News Description is required.",
            'news_category.required' =>    "News Category is required.",

        ];

        $validator = Validator::make($req->all(), [
            'news_title' => 'required',
            // 'news_image' => 'required',
            'news_description'=> 'required',
            'news_category' =>    'required',
        ], $messages);

        if ($validator->passes()) {
            $news = News::find($id);
            $news->news_title                 = $req->news_title;
            $news->news_description                 = $req->news_description;
            $old_news_image               = $req->old_news_image;
            $old_news_thumbnail = $req->old_news_thumbnail;
            $news->news_category                 = $req->news_category;
            $news->accession_number                 = $req->accession_number;
            $news->highlight                 = $req->highlight;

        if ($req->hasFile('news_image')) {

            if($old_news_image != ''){
                //unlink($old_news_image);
            }


            $file = $req->file('news_image');
            $extension = $file->getClientOriginalExtension();
            $filename = hexdec(uniqid())  . '.' . $extension;
            Image::make($file)->save(public_path('uploads/news/image' . $filename));
            //$file->move('uploads/news/image', $filename);
            $save_url = 'uploads/news/image' . $filename;
            $news->news_image = $save_url;
        }

        if ($req->hasFile('news_thumbnail')) {

            if($old_news_thumbnail!=''){
                // unlink($old_news_thumbnail);

            }

            $file = $req->file('news_thumbnail');
            $extension = $file->getClientOriginalExtension();
            $filename = hexdec(uniqid())  . '.' . $extension;
            Image::make($file)->save(public_path('uploads/news/image/thumbnail/' . $filename));
            //$file->move('uploads/news/image', $filename);
            $save_url = 'uploads/news/image/thumbnail/' . $filename;
            $news->news_thumbnail = $save_url;
        }
        $news->save();

            return response() -> json([
                'status'=>200,
                'message' => 'News updated successfully'
            ]);
        }

        return response()->json(['error'=>$validator->errors()]);

    }

    public function destroy($id){
        News::find($id)->delete($id);

        return redirect('/collection-list')->with('status', 'Deleted successfully!');
    }
}
