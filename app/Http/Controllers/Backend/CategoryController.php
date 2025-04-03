<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\Category;
// use App\Models\Subscriber;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Intervention\Image\Facades\Image;


class CategoryController extends Controller
{
    public function create(){
        // $subscribers = Subscriber::all();
        return view('backend/product/category/category-add');
    }

    public function store(Request $req){

        $messages = [
            'categoryname.required'  =>    "Category name is required.",
            'categoryimage.required'  =>    "Category image is required.",
            'category_titile_image.required'  =>    "Category title image is required.",

        ];

        $validator = Validator::make($req->all(), [
            'categoryname' => 'required',
            'categoryimage' => 'required',
            'category_titile_image' => 'required',


        ], $messages);

        if ($validator->passes()) {
            $category = new Category;

            $category->category_name                 = $req->categoryname;
            $category->description =$req->description;
            $category->desc                             = $req->desc;
            $file = $req->file('categoryimage');
            $extension = $file->getClientOriginalExtension();
            $filename = hexdec(uniqid())  . '.' . $extension;
            $save_path='uploads/product/category';
            if (!file_exists($save_path)) {
                // mkdir($save_path, 666, true);
                Image::make($file)->resize(376, 260)->save(public_path(  $save_path. $filename));
                // $file->move('uploads/sliderimage/', $filename);
                $save_url = 'uploads/product/category' . $filename;

                $category->category_image  = $save_url;
            }
            else{
                Image::make($file)->resize(360, 300)->save(public_path(  $save_path. $filename));
                // $file->move('uploads/product/category', $filename);
                $save_url = 'uploads/product/category' . $filename;

                $category->category_image  = $save_url;

            }
            $file2 = $req->file('category_titile_image');
            $extension2 = $file->getClientOriginalExtension();
            $filename2 = hexdec(uniqid())  . '.' . $extension2;
            $save_path='uploads/product/category';
            if (!file_exists($save_path)) {
                // mkdir($save_path, 666, true);
                Image::make($file2)->resize(376, 260)->save(public_path(  $save_path. $filename2));
                // $file->move('uploads/sliderimage/', $filename);
                $save_url = 'uploads/product/category' . $filename2;

                $category->title_image  = $save_url;
            }
            else{
                Image::make($file2)->resize(360, 300)->save(public_path(  $save_path. $filename2));
                // $file->move('uploads/product/category', $filename);
                $save_url = 'uploads/product/category' . $filename2;

                $category->title_image  = $save_url;

            }
            // $category->category_image                = $req->categoryimage;


            $category->save();

            return response() -> json([
                'status'=>200,
                'message' => 'Category created successfully!'
            ]);

        }

        return response()->json(['error'=>$validator->errors()]);

    }

    public function listView(){
        return view('backend/product/category/category-list');
    }

    public function list(Request $request){

        $category = Category::all();

        if($request -> ajax()){
            return response()->json([
                'category'=>$category,
            ]);
        }


    }

    public function edit($id){
        $category = Category::find($id);

        if($category){
            return response()->json([
                'status'=>200,
                'category'=>$category,

            ]);
        }
    }

    public function update(Request $req, $id){

        $messages = [
            'categoryname.required'  =>    "Category name is required.",
        ];

        $validator = Validator::make($req->all(), [
            'categoryname' => 'required',
        ], $messages);

        if ($validator->passes()) {
            $category = Category::find($id);
            $category->category_name                 = $req->categoryname;
            $category->description =$req-> edit_description ;
            $category->desc                             = $req->edit_desc;
            $old_categoryimage=$req->old_categoryimage;

        if ($req->hasFile('categoryimage')) {

            // unlink($old_categoryimage);

            $file = $req->file('categoryimage');
            $extension = $file->getClientOriginalExtension();
            $filename = hexdec(uniqid())  . '.' . $extension;
            Image::make($file)->save(public_path('uploads/product/category' . $filename));
            //$file->move('uploads/product/category', $filename);
            $save_url = 'uploads/product/category' . $filename;
            $category->category_image = $save_url;
        }
        if ($req->hasFile('titleimage')) {

            // unlink($old_titleimage);

            $file1 = $req->file('titleimage');
            $extension1 = $file1->getClientOriginalExtension();
            $filename1 = hexdec(uniqid())  . '.' . $extension1;
            Image::make($file1)->save(public_path('uploads/product/category' . $filename1));
            //$file->move('uploads/product/category', $filename);
            $save_url = 'uploads/product/category' . $filename1;
            $category->title_image = $save_url;
        }
        $category->save();

            return response() -> json([
                'status'=>200,
                'message' => 'Category updated successfully'
            ]);
        }

        return response()->json(['error'=>$validator->errors()]);

    }

    public function destroy($id){
        Category::find($id)->delete($id);

        return redirect('category-list')->with('status', 'Deleted successfully!');
    }
}
