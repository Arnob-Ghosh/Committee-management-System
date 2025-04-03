<?php

namespace App\Http\Controllers\Backend;

use App\Models\Accessory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\AccessoriesCategory;
use App\Models\AccessoriesImageUrl;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\Models\AccessoriesPromoSlider;
use Illuminate\Support\Facades\Validator;

class AccessoriesController extends Controller
{
    public function create()
    {
        $brands = DB::table('brands')
            ->select('brands.*', 'categories.category_name')
            ->join('categories', 'brands.category_id', '=', 'categories.id')
            ->where('categories.category_name', 'Accosories')
            ->get();
        $categories = AccessoriesCategory::all();
        return view('backend/product/accessories/accessories-add', compact('brands', 'categories'));
    }

    public function store(Request $req)
    {
        $messages = [
            'brand_id.required' => 'Brand name is required.',
            'category_id.required' => 'Category name is required.',

            'product_id.required' => 'Product id is required.',
            'product_id.unique' => 'Product id is allready inserted.Try another one.',
            'product_image.required' => 'Product Image is required.',
            'default_image.required' => 'Default Image is required.',
            'highlighted_spec.required' => 'Highlighted Spec Image is required.',
            'description.required' => 'Product description is required.',
            'product_name.required'=> 'Product name is required.',
            'status.required'=> 'Status is required.',
        ];

        $validator = Validator::make(
            $req->all(),
            [
                'brand_id' => 'required',
                'category_id' => 'required',
                'product_id' => 'required|unique:accessories',
                'product_image' => 'required',
                'highlighted_spec' => 'required',
                'default_image'=> 'required',
                'description' => 'required',
                'product_name'=> 'required',
                'status'=> 'required',

            ],
            $messages,
        );
        if ($validator->passes()) {
            $accessory = new Accessory();
            // Log::info("message");
            $accessory->brand_id = $req->brand_id;
            $accessory->category_id = $req->category_id;
            $accessory->product_id = $req->product_id;
            $accessory->product_name = $req->product_name;
            $accessory->description = $req->description;
            $accessory->status=$req->status;

            if ($req->hasFile('default_image')) {
                $file = $req->file('default_image');
                $extension = $file->getClientOriginalExtension();
                // $filename =$file->getClientOriginalName(). '.' . $extension;
                $filename = $file->getClientOriginalName();

                $save_path = 'uploads/product/accessories/default_image/';
                if (!file_exists($save_path)) {
                    // mkdir($save_path, 666, true);
                    Image::make($file)
                        ->resize(280, 280)
                        ->save(public_path($save_path . $filename));
                    // $file->move($save_path, $filename);
                    $save_url = 'uploads/product/accessories/default_image/' . $filename;

                    $accessory->default_image = $save_url;
                } else {
                    Image::make($file)
                        ->resize(280, 280)
                        ->save(public_path($save_path . $filename));

                    // $file->move($save_path, $filename);
                    $save_url = 'uploads/product/accessories/default_image/' . $filename;

                    $accessory->default_image = $save_url;
                }
            }

            if ($req->hasFile('highlighted_spec')) {
                $file = $req->file('highlighted_spec');
                $extension = $file->getClientOriginalExtension();
                // $filename =$file->getClientOriginalName(). '.' . $extension;
                $filename = $file->getClientOriginalName();

                $save_path = 'uploads/product/accessories/highlighted_spec/';
                if (!file_exists($save_path)) {
                    // mkdir($save_path, 666, true);
                    Image::make($file)
                        ->resize(570, 440)
                        ->save(public_path($save_path . $filename));
                    // $file->move($save_path, $filename);
                    $save_url = 'uploads/product/accessories/highlighted_spec/' . $filename;

                    $accessory->highlighted_spec = $save_url;
                } else {
                    Image::make($file)
                        ->resize(570, 440)
                        ->save(public_path($save_path . $filename));

                    // $file->move($save_path, $filename);
                    $save_url = 'uploads/product/accessories/highlighted_spec/' . $filename;

                    $accessory->highlighted_spec = $save_url;
                }
            }


            if ($req->hasFile('product_image')) {
                $file = $req->file('product_image');
                $extension = $file->getClientOriginalExtension();
                // $filename =$file->getClientOriginalName(). '.' . $extension;
                $filename = $file->getClientOriginalName();

                $save_path = 'uploads/product/accessories/product_image/';
                if (!file_exists($save_path)) {
                    // mkdir($save_path, 666, true);
                    Image::make($file)
                        ->resize(570, 570)
                        ->save(public_path($save_path . $filename));
                    // $file->move('uploads/sliderimage/', $filename);
                    $save_url = 'uploads/product/accessories/product_image/' . $filename;

                    $accessory->product_image = $save_url;
                } else {
                    Image::make($file)
                        ->resize(570, 570)
                        ->save(public_path($save_path . $filename));
                    // $file->move('uploads/product/accessories/product_image/', $filename);
                    $save_url = 'uploads/product/accessories/product_image/' . $filename;

                    $accessory->product_image = $save_url;
                }
            }

            $accessory->save();

            return response()->json([
                'status' => 200,
                'message' => 'Accessory created Successfully',
            ]);
        }
        return response()->json(['error' => $validator->errors()]);
    }

    public function list()
    {
        $data = Accessory::all();
        // Log::info( $data);
        return view('backend/product/accessories/accessories-list', compact('data'));
    }


    public function edit($id)
    {
        $brands = DB::table('brands')
            ->select('brands.*', 'categories.category_name')
            ->join('categories', 'brands.category_id', '=', 'categories.id')
            ->where('categories.category_name', 'Accosories')
            ->get();
        $categories = AccessoriesCategory::all();
        $data = Accessory::find($id);
        return view('backend/product/accessories/accessories-edit', compact('data', 'brands', 'categories'));
    }

    public function update(Request $req, $id)
    {
        $messages = [
            'brand_id.required' => 'Brand name is required.',
            'category_id.required' => 'Category name is required.',
            'product_name.required'=> 'Product name is required.',
            'product_id.required' => 'Product id is required.',
            'product_id.unique' => 'Product id is allready inserted.Try another one.',
            'status.required'=> 'Status is required.',
            // 'product_image.required' => 'Product Image is required.',

            // 'highlighted_spec.required' => 'Highlighted Spec Image is required.',
            'description.required' => 'Product description is required.',
        ];

        $validator = Validator::make(
            $req->all(),
            [
                'brand_id' => 'required',
                'category_id' => 'required',
                // 'product_id' => 'required|unique:accessories,product_id' . $id,
                'product_id' =>  [
                    'required',
                    Rule::unique('accessories')->ignore($id),
                ],
                 'product_name' => 'required',
                // 'product_image' => 'required',
                // 'highlighted_spec' => 'required',
                'description' => 'required',
                 'status'=> 'required',


            ],
            $messages,
        );
        if ($validator->passes()) {
            $accessory =  Accessory::find($id);
            // Log::info("message");
            $accessory->brand_id = $req->brand_id;
            $accessory->category_id = $req->category_id;
            $accessory->product_id = $req->product_id;
            $accessory->product_name = $req->product_name;
            $accessory->description = $req->description;
            $accessory->status=$req->status;
            $old_highlighted_spec = $req->old_highlighted_spec;
            $old_product_image = $req->old_product_image;
            $ole_default_image=$req->ole_default_image;

            if ($req->hasFile('default_image')) {
                if ($ole_default_image != '') {
                    // unlink(public_path($ole_default_image));
                }
                $file = $req->file('default_image');
                $extension = $file->getClientOriginalExtension();
                // $filename =$file->getClientOriginalName(). '.' . $extension;
                $filename = $file->getClientOriginalName();

                $save_path = 'uploads/product/accessories/default_image/';
                if (!file_exists($save_path)) {
                    // mkdir($save_path, 666, true);
                    Image::make($file)
                        ->resize(280, 280)
                        ->save(public_path($save_path . $filename));
                    // $file->move($save_path, $filename);
                    $save_url = 'uploads/product/accessories/default_image/' . $filename;

                    $accessory->default_image = $save_url;
                } else {
                    Image::make($file)
                        ->resize(280, 280)
                        ->save(public_path($save_path . $filename));

                    // $file->move($save_path, $filename);
                    $save_url = 'uploads/product/accessories/default_image/' . $filename;

                    $accessory->default_image = $save_url;
                }
            }

            if ($req->hasFile('highlighted_spec')) {

                if ($old_highlighted_spec != '') {
                    // unlink(public_path($old_highlighted_spec));
                }
                $file = $req->file('highlighted_spec');
                $extension = $file->getClientOriginalExtension();
                // $filename =$file->getClientOriginalName(). '.' . $extension;
                $filename = $file->getClientOriginalName();

                $save_path = 'uploads/product/accessories/highlighted_spec/';
                if (!file_exists($save_path)) {
                    // mkdir($save_path, 666, true);
                    Image::make($file)
                        ->resize(570, 440)
                        ->save(public_path($save_path . $filename));
                    // $file->move($save_path, $filename);
                    $save_url = 'uploads/product/accessories/highlighted_spec/' . $filename;

                    $accessory->highlighted_spec = $save_url;
                } else {
                    Image::make($file)
                        ->resize(570, 440)
                        ->save(public_path($save_path . $filename));

                    // $file->move($save_path, $filename);
                    $save_url = 'uploads/product/accessories/highlighted_spec/' . $filename;

                    $accessory->highlighted_spec = $save_url;
                }
            }

            if ($req->hasFile('product_image')) {

                if ($old_product_image != '') {
                    // unlink(public_path($old_product_image));
                }
                $file = $req->file('product_image');
                $extension = $file->getClientOriginalExtension();
                // $filename =$file->getClientOriginalName(). '.' . $extension;
                $filename = $file->getClientOriginalName();

                $save_path = 'uploads/product/accessories/product_image/';
                if (!file_exists($save_path)) {
                    // mkdir($save_path, 666, true);
                    Image::make($file)
                        ->resize(570, 570)
                        ->save(public_path($save_path . $filename));
                    // $file->move('uploads/sliderimage/', $filename);
                    $save_url = 'uploads/product/accessories/product_image/' . $filename;

                    $accessory->product_image = $save_url;
                } else {
                    Image::make($file)
                        ->resize(570, 570)
                        ->save(public_path($save_path . $filename));
                    // $file->move('uploads/product/accessories/product_image/', $filename);
                    $save_url = 'uploads/product/accessories/product_image/' . $filename;

                    $accessory->product_image = $save_url;
                }
            }

            $accessory->save();

            return response()->json([
                'status' => 200,
                'message' => 'Accessory updated Successfully',
            ]);
        }
        return response()->json(['error' => $validator->errors()]);
    }


    public function destroy($id)
    {
        Accessory::find($id)->delete();
        $notification = [
            'message' => 'Deleted succesfully',
            'alert-type' => 'success',
        ];
        return redirect()
            ->route('accessories.list.view')
            ->with($notification);
    }
    //accessoriesCategory

    public function accessoriesCategoryCreate()
    {
    }
    public function accessoriesCategoryStore(Request $req)
    {
        $messages = [
            'accessoriesCategory_name.required'  =>    "Category name is required.",
        ];

        $validator = Validator::make($req->all(), [
            'accessoriesCategory_name' => 'required',
        ], $messages);

        if ($validator->passes()) {
            $category = new AccessoriesCategory;

            $category->category_name                 = $req->accessoriesCategory_name;

            $category->save();

            return response()->json([
                'status' => 200,
                'message' => 'Category created successfully!'
            ]);
        }

        return response()->json(['error' => $validator->errors()]);
    }
    public function accessoriesCategoryListView()
    {
        return view('backend/product/accessories/category/category-list');
    }
    public function accessoriesCategoryList(Request $request)
    {
        $category = AccessoriesCategory::all();

        return response()->json([
            'data' => $category,
        ]);
    }
    public function accessoriesCategoryEdit($id)
    {
        $data = AccessoriesCategory::find($id);
        return response()->json([
            'data' => $data,
            'status' => 200,
        ]);
    }
    public function accessoriesCategoryUpdate(Request $req, $id)
    {
        $messages = [
            'accessoriesCategory_name.required' => 'Category Name is required.',
            'accessoriesCategory_name.min' => 'Category Name is too short.Minimum 3 character needed .',
        ];

        $validator = Validator::make(
            $req->all(),
            [
                'accessoriesCategory_name' => 'required|min:2',
            ],
            $messages,
        );

        if ($validator->passes()) {
            $category = AccessoriesCategory::find($id);
            // $category = new SmartPhoneSpecificationCategory()
            $category->category_name = $req->accessoriesCategory_name;

            $category->save();

            return response()->json([
                'status' => 200,
                'message' => 'Category update successfully!',
            ]);
        }

        return response()->json(['error' => $validator->errors()]);
    }
    public function accessoriesCategoryDestroy($id)
    {
        AccessoriesCategory::find($id)->delete($id);
        return response()->json([
            'status' => 200,
            'message' => 'SCategory  deleted successfully!',
        ]);
    }

    //promo-slider
    public function sliderListView()
    {
        $sliders = AccessoriesPromoSlider::latest()->get();
        return view('backend/product/accessories/slider/slider-index', compact('sliders'));
    }

    public function sliderCreate()
    {
        return view('backend/product/accessories/slider/slider-add');
    }

    public function sliderStore(Request $request)
    {
        $request->validate([
            'slider' => 'required',
            'thumbnail' => 'required',
        ]);
        $data = new AccessoriesPromoSlider();

        $file = $request->file('slider');
        $extension = $file->getClientOriginalExtension();
        $filename = hexdec(uniqid()) . '.' . $extension;
        $save_path = 'uploads/product/accessories/sliderimage/';
        if (!file_exists($save_path)) {
            // mkdir($save_path, 666, true);
            // Image::make($file)
            //     ->resize(1440, 600)
            //     ->save(public_path($save_path . $filename));
            //   $file->move(public_path($save_path), $filename);
            $file->move(public_path($save_path), $filename);
            $save_url = 'uploads/product/accessories/sliderimage/' . $filename;

            $data->slider = $save_url;
        } else {
            // Image::make($file)
            //     ->resize(1440, 600)
            //     ->save(public_path($save_path . $filename));
               $file->move(public_path($save_path), $filename);
            $save_url = 'uploads/product/accessories/sliderimage/' . $filename;

            $data->slider = $save_url;
        }
        $file1 = $request->file('thumbnail');
        $extension1 = $file->getClientOriginalExtension();
        $filename1 = hexdec(uniqid()) . '.' . $extension1;
        $save_path = 'uploads/product/accessories/sliderimage/';
        if (!file_exists($save_path)) {
            // mkdir($save_path, 666, true);
            // Image::make($file)
            //     ->resize(1440, 600)
            //     ->save(public_path($save_path . $filename));
            //   $file->move(public_path($save_path), $filename);
            $file1->move(public_path($save_path), $filename1);
            $save_url = 'uploads/product/accessories/sliderimage/' . $filename1;

            $data->thumbnail = $save_url;
        } else {
            // Image::make($file)
            //     ->resize(1440, 600)
            //     ->save(public_path($save_path . $filename));
               $file1->move(public_path($save_path), $filename1);
            $save_url = 'uploads/product/accessories/sliderimage/' . $filename1;

            $data->thumbnail = $save_url;
        }

        $data->title = $request->title;
        $data->description = $request->description;
        $data->status = $request->status;
        $data->start_date = $request->start;
        $data->end_date = $request->end;

        $data->save();

        $notification = [
            'message' => 'Exibiton Added succesfull',
            'alert-type' => 'success',
        ];
        return redirect()
            ->route('exibition.list.view')
            ->with($notification);
    }

    public function sliderEdit($id)
    {
        $data = AccessoriesPromoSlider::find($id);
        return view('backend/product/accessories/slider/slider-edit', compact('data'));
    }

    public function sliderUpdate(Request $request, $id)
    {
        $data = AccessoriesPromoSlider::find($id);
        $old_img = public_path($request->old_image);

        $data->title = $request->title;
        $data->description = $request->description;
        $data->status = $request->status;
        $save_path = 'uploads/product/accessories/sliderimage/';

        if ($request->hasFile('slider')) {
            if ($old_img != '') {
                // unlink($old_img);
            }

            $file = $request->file('slider');
            $extension = $file->getClientOriginalExtension();
            $filename = hexdec(uniqid()) . '.' . $extension;
            // Image::make($file)
            //     ->resize(1440, 600)
            //     ->save(public_path('uploads/product/accessories/sliderimage/' . $filename));
              $file->move(public_path($save_path), $filename);
            $save_url = 'uploads/product/accessories/sliderimage/' . $filename;
            $data->slider = $save_url;
        }
           if ($request->hasFile('thumbnail')) {
            if ($old_img != '') {
                // unlink($old_img);
            }

            $file1 = $request->file('thumbnail');
            $extension1 = $file1->getClientOriginalExtension();
            $filename1 = hexdec(uniqid()) . '.' . $extension1;
            // Image::make($file)
            //     ->resize(1440, 600)
            //     ->save(public_path('uploads/product/accessories/sliderimage/' . $filename));
              $file1->move(public_path($save_path), $filename1);
            $save_url = 'uploads/product/accessories/sliderimage/' . $filename1;
            $data->thumbnail = $save_url;
        }
        $data->save();

        $notification = [
            'message' => 'Exibition Updated succesfully',
            'alert-type' => 'success',
        ];
        return redirect()
            ->route('exibition.list.view')
            ->with($notification);
    }

    public function sliderDestroy($id)
    {
        $data = AccessoriesPromoSlider::findOrFail($id);
        $img = $data->slider;
        if ($img != '') {
            // unlink(public_path($img));
        }

        AccessoriesPromoSlider::findOrFail($id)->delete();
        $notification = [
            'message' => 'Exibition deleted succesfully',
            'alert-type' => 'success',
        ];
        return redirect()
            ->back()
            ->with($notification);
    }

    //image Link
    public function imageLinkList()
    {
        $links = AccessoriesImageUrl::latest()->get();
        return view('backend/product/accessories/link-image/link-image-index', compact('links'));
    }

    public function imageLinkCreate()
    {
        return view('backend/product/accessories/link-image/link-image-add');
    }

    public function imageLinkStore(Request $request)
    {
        $request->validate([
            'file' => 'required',
        ]);
        $data = new AccessoriesImageUrl();
        $url= $request->url;
        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();
        $filename = hexdec(uniqid()) . '.' . $extension;
        $save_path = 'uploads/product/accessories/link-image/';
        if (!file_exists($save_path)) {
            // mkdir($save_path, 666, true);
            // Image::make($file)
            //     ->resize(1440, 600)
            //     ->save(public_path($save_path . $filename));
            //   $file->move(public_path($save_path), $filename);
            $file->move(public_path($save_path), $filename);
            $save_url = 'uploads/product/accessories/link-image/' . $filename;

            $data->file = $save_url;
            $data->url = $url.'/'.$save_url;
        } else {
            // Image::make($file)
            //     ->resize(1440, 600)
            //     ->save(public_path($save_path . $filename));
               $file->move(public_path($save_path), $filename);
            $save_url = 'uploads/product/accessories/link-image/' . $filename;

            $data->file = $save_url;
            $data->url = $url.'/'.$save_url;

        }



        $data->save();

        $notification = [
            'message' => 'Link Added succesfully',
            'alert-type' => 'success',
        ];
        return redirect()
            ->route('accessories.link.list.view')
            ->with($notification);
    }

    public function imageLinkEdit($id)
    {
        $data = AccessoriesImageUrl::find($id);
        return view('backend/product/accessories/link-image/link-image-edit', compact('data'));
    }

    public function imageLinkUpdate(Request $request, $id)
    {
        $data = AccessoriesImageUrl::find($id);
        $old_img = public_path($request->old_image);

        $url= $request->url;

        $save_path = 'uploads/product/accessories/link-image/';

        if ($request->hasFile('file')) {
            if ($old_img != '') {
                // unlink($old_img);
            }

            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = hexdec(uniqid()) . '.' . $extension;
            // Image::make($file)
            //     ->resize(1440, 600)
            //     ->save(public_path('uploads/product/accessories/sliderimage/' . $filename));
              $file->move(public_path($save_path), $filename);
            $save_url = 'uploads/product/accessories/link-image/' . $filename;
            $data->file = $save_url;
            $data->url = $url.'/'.$save_url;
        }
        $data->save();

        $notification = [
            'message' => 'Link Updated succesfully',
            'alert-type' => 'success',
        ];
        return redirect()
            ->route('accessories.link.list.view')
            ->with($notification);
    }

    public function imageLinkDestroy($id)
    {
        $data = AccessoriesImageUrl::findOrFail($id);
        $img = $data->file;
        if ($img != '') {
            // unlink(public_path($img));
        }

        AccessoriesImageUrl::findOrFail($id)->delete();
        $notification = [
            'message' => 'Link deleted succesfully',
            'alert-type' => 'success',
        ];
        return redirect()
            ->back()
            ->with($notification);
    }
}



