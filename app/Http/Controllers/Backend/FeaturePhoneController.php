<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeaturePhone;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;
use App\Models\FeaturePhoneVariant;
use App\Models\ProductPromoSlider;
use App\Models\FeaturePhoneOverViewImage;
use Illuminate\Support\Facades\DB;
use App\Models\Brand;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\FeaurePhoneSpecificationImport;

class FeaturePhoneController extends Controller
{
    public function create()
    {
        $brands = DB::table('brands')
            ->select('brands.*', 'categories.category_name')
            ->join('categories', 'brands.category_id', '=', 'categories.id')
            ->where('categories.id', '2')
            ->get();
        return view('backend/product/feature-phone/feature-phone-add', compact('brands'));
    }

    public function getModel($id)
    {
        $data = DB::table('feature_phones')
            ->select('id', 'model_name')
            ->where('brand_id', $id)
            ->get();
        return response()->json([
            'status' => 200,
            'data' => $data,
        ]);
    }

    public function store(Request $req)
    {
        $messages = [
            'brand_id.required' => 'Brand name is required.',
            'model_name.required' => 'Model name is required.',

            'product_id.required' => 'Product id is required.',
            'num_colour.required' => 'Number of Colour is required.',
            'display_size.required' => 'Display size  is required.',
            'battery.required' => 'Battery  is required.',
            'camera.required' => 'Camera  is required.',
            // 'file.required' => 'Specification is required.',
            'network_parameter.required' => 'Network Parameter is required.',
            'highlighted_spec.required' => 'Highlighted Spec Image is required.',
            'in_box_image.required' => 'In The Box Image is required.',
            'default_image.required' => 'Default Image is required.',
            'status.required' => 'Status is required.',
        ];

        $validator = Validator::make(
            $req->all(),
            [
                'brand_id' => 'required',
                'model_name' => 'required',
                'product_id' => 'required',
                'num_colour' => 'required',
                'display_size' => 'required',
                'battery' => 'required',
                'camera' => 'required',
                // 'file' => 'required|mimes:xlsx,csv',
                'network_parameter' => 'required',
                'highlighted_spec' => 'required',
                'in_box_image' => 'required',
                'default_image' => 'required',
                'status' => 'required',
            ],
            $messages,
        );

        if ($validator->passes()) {
            $feature_phone = new FeaturePhone();
            // Log::info("message");
            $feature_phone->model_name = $req->model_name;
            $feature_phone->product_id = $req->product_id;
            $feature_phone->num_colour = $req->num_colour;
            $feature_phone->display_size = $req->display_size;
            $feature_phone->battery = $req->battery;
            $feature_phone->camera = $req->camera;
            $feature_phone->brand_id = $req->brand_id;
            $feature_phone->network_parameter = $req->network_parameter;
            $feature_phone->status = $req->status;
            // $feature_phone->model_specification=$req->model_specification;
            $feature_phone->highlighted_spec = $req->highlighted_spec;

            if ($req->hasFile('highlighted_spec')) {
                $file = $req->file('highlighted_spec');
                $extension = $file->getClientOriginalExtension();
                // $filename =$file->getClientOriginalName(). '.' . $extension;
                $filename = $file->getClientOriginalName();

                $save_path = 'uploads/product/featurephone/specs/';
                if (!file_exists($save_path)) {
                    // mkdir($save_path, 666, true);
                    // Image::make($file)
                    //     ->resize(570, 380)
                    //     ->save(public_path($save_path . $filename));
                    // $file->move(public_path($save_path, $filename));
                    $file->move(public_path($save_path), $filename);
                    $save_url = 'uploads/product/featurephone/specs/' . $filename;

                    $feature_phone->highlighted_spec = $save_url;
                } else {
                    // Image::make($file)
                    //     ->resize(570, 380)
                    //     ->save(public_path($save_path . $filename));

                    // $file->move(public_path($save_path, $filename));
                    $file->move(public_path($save_path), $filename);
                    $save_url = 'uploads/product/featurephone/specs/' . $filename;

                    $feature_phone->highlighted_spec = $save_url;
                }
            }
            if ($req->hasFile('in_box_image')) {
                $file = $req->file('in_box_image');
                $extension = $file->getClientOriginalExtension();
                // $filename =$file->getClientOriginalName(). '.' . $extension;
                $filename = $file->getClientOriginalName();

                $save_path = 'uploads/product/featurephone/in_the_box/';
                if (!file_exists($save_path)) {
                    // mkdir($save_path, 666, true);
                    // Image::make($file)
                    //     ->resize(1100, 400)
                    //     ->save(public_path($save_path . $filename));
                    // $file->move($save_path, $filename);
                    // $file->move(public_path($save_path, $filename));
                    $file->move(public_path($save_path), $filename);

                    $save_url =   $save_path . $filename;

                    $feature_phone->in_box_image = $save_url;
                } else {
                    // Image::make($file)
                    //     ->resize(1100, 400)
                    //     ->save(public_path($save_path . $filename));
                    $file->move(public_path($save_path, $filename));

                    $save_url =   $save_path . $filename;

                    $feature_phone->in_box_image = $save_url;
                }
            }

            if ($req->hasFile('default_image')) {
                $file = $req->file('default_image');
                $extension = $file->getClientOriginalExtension();
                // $filename =$file->getClientOriginalName(). '.' . $extension;
                $filename = $file->getClientOriginalName();

                $save_path = 'uploads/product/featurephone/default-image/';
                if (!file_exists($save_path)) {
                    // mkdir($save_path, 666, true);
                    Image::make($file)
                        ->resize(280, 280)
                        ->save(public_path($save_path . $filename));
                    // $file->move('uploads/sliderimage/', $filename);
                    $save_url = 'uploads/product/featurephone/default-image/' . $filename;

                    $feature_phone->default_image = $save_url;
                } else {
                    Image::make($file)
                        ->resize(280, 280)
                        ->save(public_path($save_path . $filename));
                    // $file->move('uploads/product/featurephone/default-image/', $filename);
                    $save_url = 'uploads/product/featurephone/default-image/' . $filename;

                    $feature_phone->default_image = $save_url;
                }
            }

            $feature_phone->save();
            $model_id = DB::getPdo()->lastInsertId();
            $file = $req->file('file');

            return response()->json([
                'status' => 200,
                'message' => 'Brand created Successfully!',
            ]);
        }
        return response()->json(['error' => $validator->errors()]);
    }

    public function list()
    {
        $data = FeaturePhone::all();
        return view('backend/product/feature-phone/feature-phone-list', compact('data'));
    }

    public function edit($id)
    {
        $brands = DB::table('brands')
            ->select('brands.*', 'categories.category_name')
            ->join('categories', 'brands.category_id', '=', 'categories.id')
            ->where('categories.id', '2')
            ->get();
        $data = FeaturePhone::find($id);
        return view('backend/product/feature-phone/feature-phone-edit', compact('data', 'brands'));
    }

    public function update(Request $req, $id)
    {
        $messages = [
            'brand_id.required' => 'Brand name is required.',
            'model_name.required' => 'Model name is required.',
            'product_id.required' => 'Product id is required.',
            'num_colour.required' => 'Number of Colour is required.',
            'display_size.required' => 'Display size  is required.',
            'battery.required' => 'Battery  is required.',
            'camera.required' => 'Camera  is required.',
            // 'file.required' => 'Specification is required.',
            // 'default_image.required'=> 'Default Image is required.',
            'network_parameter.required' => 'Network Parameter is required.',
            'status.required' => 'Status is required.',


            // 'highlighted_spec.required' => 'Highlighted Spec Image is required.',
            // 'in_box_image.required' => 'In The Box Image is required.',
        ];

        $validator = Validator::make(
            $req->all(),
            [
                'brand_id' => 'required',
                'model_name' => 'required',
                'product_id' => 'required',
                'num_colour' => 'required',
                'display_size' => 'required',
                'battery' => 'required',
                'camera' => 'required',
                // 'file' => 'required|mimes:xlsx,csv',
                'network_parameter' => 'required',
                'status' => 'required',
                // 'default_image'=> 'required',
                // 'highlighted_spec' => 'required',
                // 'in_box_image' => 'required',
            ],
            $messages,
        );

        if ($validator->passes()) {
            $feature_phone = FeaturePhone::find($id);
            $feature_phone->brand_id = $req->brand_id;
            $feature_phone->model_name = $req->model_name;
            $feature_phone->product_id = $req->product_id;
            $feature_phone->num_colour = $req->num_colour;
            $feature_phone->display_size = $req->display_size;
            $feature_phone->battery = $req->battery;
            $feature_phone->camera = $req->camera;
            $feature_phone->network_parameter = $req->network_parameter;
            $feature_phone->status = $req->status;

            if ($req->hasFile('highlighted_spec')) {
                $file = $req->file('highlighted_spec');
                $extension = $file->getClientOriginalExtension();
                // $filename =$file->getClientOriginalName(). '.' . $extension;
                $filename = $file->getClientOriginalName();

                $save_path = 'uploads/product/featurephone/default-image/';

                Image::make($file)
                    ->resize(570, 380)
                    ->save(public_path($save_path . $filename));
                // $file->move('uploads/product/featurephone/specs/', $filename);
                $save_url = 'uploads/product/featurephone/default-image/' . $filename;

                $feature_phone->highlighted_spec = $save_url;
            }
            if ($req->hasFile('in_box_image')) {
                $file = $req->file('in_box_image');
                $extension = $file->getClientOriginalExtension();
                // $filename =$file->getClientOriginalName(). '.' . $extension;
                // $filename = $file->getClientOriginalName();
                $filename = $file->getClientOriginalName() . '.' . $extension;
                // $filename = $file->getClientOriginalName();

                $save_path = 'uploads/product/featurephone/in_the_box/';

                // Image::make($file)
                //     ->resize(1100, 400)
                //     ->save(public_path($save_path . $filename));
                $file->move(public_path($save_path), $filename);
                $save_url = $save_path . $filename;

                $feature_phone->in_box_image = $save_url;
            }
            if ($req->hasFile('default_image')) {
                $file = $req->file('default_image');
                $extension = $file->getClientOriginalExtension();
                // $filename =$file->getClientOriginalName(). '.' . $extension;
                $filename = $file->getClientOriginalName();
                $save_path = 'uploads/product/featurephone/default-image/';
                if (!file_exists($save_path)) {
                    // mkdir($save_path, 666, true);
                    Image::make($file)
                        ->resize(280, 280)
                        ->save(public_path($save_path . $filename));
                    // $file->move($save_path, $filename);
                    $save_url = 'uploads/product/featurephone/default-image/' . $filename;

                    $feature_phone->default_image = $save_url;
                } else {
                    Image::make($file)
                        ->resize(280, 280)
                        ->save(public_path($save_path . $filename));
                    // $file->move($save_path, $filename);

                    $save_url = 'uploads/product/featurephone/default-image/' . $filename;

                    $feature_phone->default_image = $save_url;
                }
            }

            $feature_phone->save();


            return response()->json([
                'status' => 200,
                'message' => 'Brand created Successfully!',
            ]);
        }

        return response()->json(['error' => $validator->errors()]);
    }

    public function destroy($id)
    {
        FeaturePhone::find($id)->delete();
        $notification = [
            'message' => 'Variant Deleted succesfully',
            'alert-type' => 'warning',
        ];
        return redirect()
            ->back()
            ->with($notification);
    }

    //over view image
    public function OverViewImageCreate()
    {
        $data = DB::table('feature_phones')
            ->select('id', 'model_name')
            ->get();
        $brands = DB::table('brands')
            ->select('brands.*', 'categories.category_name')
            ->join('categories', 'brands.category_id', '=', 'categories.id')
            ->where('categories.id', '2')
            ->get();
        return view('backend/product/feature-phone/overview-image/overview-image-create', compact('data', 'brands'));
    }

    public function OverViewImageList()
    {
        $data = FeaturePhoneOverViewImage::all();
        return view('backend/product/feature-phone/overview-image/overview-image-list', compact('data'));
    }

    public function OverViewDataStore(Request $req)
    {
        // Log::Info($req->all());
        $data = new FeaturePhoneOverViewImage();
        $data->brand_id = $req->brand_id;
        $data->model_id = $req->model_id;
        if ($req->hasFile('upper_image')) {
            // if($old_upper_image !='null'){
            //     unlink(public_path($old_upper_image));
            // }

            $file = $req->file('upper_image');
            $extension = $file->getClientOriginalExtension();
            // $filename =$file->getClientOriginalName(). '.' . $extension;
            $filename = $file->getClientOriginalName();

            $save_path = 'uploads/product/featurephone/overview/';

            // $file->move($save_path, $filename);
            $file->move(public_path($save_path), $filename);
            $save_url = 'uploads/product/featurephone/overview/' . $filename;

            $data->upper_image = $save_url;
        }

        if ($req->hasFile('lower_image')) {
            // if($old_lower_image !='null'){
            //     unlink(public_path($old_lower_image));
            // }


            $file = $req->file('lower_image');
            $extension = $file->getClientOriginalExtension();
            // $filename =$file->getClientOriginalName(). '.' . $extension;
            $filename = $file->getClientOriginalName();

            $save_path = 'uploads/product/featurephone/overview/';

            $file->move(public_path($save_path), $filename);
            // $file->move($save_path, $filename);
            $save_url = 'uploads/product/featurephone/overview/' . $filename;

            $data->lower_image = $save_url;
        }
        $data->save();
        $notification = [
            'message' => 'Uploaded Succesfully',
            'alert-type' => 'success',
        ];
        return redirect()
            ->route('feature.phone.overview.img.list.view')
            ->with($notification);

    }
    public function OverViewImageEdit($id)
    {
        $data = FeaturePhoneOverViewImage::find($id);

        return view('backend/product/feature-phone/overview-image/overview-image-edit', compact('data'));
    }

    public function OverViewDataUpdate(Request $req, $id)
    {
        $data = FeaturePhoneOverViewImage::find($id);
        $old_upper_image = $req->old_upper_image;
        $old_lower_image = $req->old_lower_image;


        if ($req->hasFile('upper_image')) {
            // if($old_upper_image !='null'){
            //     unlink(public_path($old_upper_image));
            // }

            $file = $req->file('upper_image');
            $extension = $file->getClientOriginalExtension();
            // $filename =$file->getClientOriginalName(). '.' . $extension;
            $filename = $file->getClientOriginalName();

            $save_path = 'uploads/product/featurephone/overview/';

            // $file->move($save_path, $filename);
            $file->move(public_path($save_path), $filename);
            $save_url = 'uploads/product/featurephone/overview/' . $filename;

            $data->upper_image = $save_url;
        }

        if ($req->hasFile('lower_image')) {
            // if($old_lower_image !='null'){
            //     unlink(public_path($old_lower_image));
            // }


            $file = $req->file('lower_image');
            $extension = $file->getClientOriginalExtension();
            // $filename =$file->getClientOriginalName(). '.' . $extension;
            $filename = $file->getClientOriginalName();

            $save_path = 'uploads/product/featurephone/overview/';

            $file->move(public_path($save_path), $filename);
            // $file->move($save_path, $filename);
            $save_url = 'uploads/product/featurephone/overview/' . $filename;

            $data->lower_image = $save_url;
        }
        $data->save();
        $notification = [
            'message' => 'Updated Succesfully',
            'alert-type' => 'success',
        ];
        return redirect()
            ->route('feature.phone.overview.img.list.view')
            ->with($notification);
    }

    public function OverViewImageDestroy($id)
    {
        $data = FeaturePhoneOverViewImage::find($id);
        $old_upper_image = $data->upper_image;
        $old_lower_image = $data->lower_image;
        // if($old_lower_image !='null'){
        //     unlink(public_path($old_lower_image));
        // }
        // if($old_upper_image !='null'){
        //     unlink(public_path($old_upper_image));
        // }
        $data->delete();
        $notification = [
            'message' => 'Deleted succesfully',
            'alert-type' => 'warning',
        ];
        return redirect()
            ->back()
            ->with($notification);
    }

    public function OverViewImageStore(Request $req)
    {
        $variant = new FeaturePhoneOverViewImage();
        // Log::info($req->all());
        if ($req->hasFile('upper_image')) {
            $file = $req->file('upper_image');
            $extension = $file->getClientOriginalExtension();
            // $filename =$file->getClientOriginalName(). '.' . $extension;
            $filename = $file->getClientOriginalName();
            $save_path = 'uploads/product/featurephone/overview/';
            $file->move(public_path($save_path), $filename);
            $save_url = 'uploads/product/featurephone/overview/' . $filename;
        }
        if ($req->hasFile('lower_image')) {
            $file = $req->file('lower_image');
            $extension = $file->getClientOriginalExtension();
            // $filename =$file->getClientOriginalName()  . '.' . $extension;
            $filename = $file->getClientOriginalName();

            $save_path = 'uploads/product/featurephone/overview/';
            $file->move(public_path($save_path), $filename);

            $save_url = 'uploads/product/featurephone/overview/' . $filename;

            $variant->lower_image = $save_url;
        }
        return response()->json([
            'status' => 200,
            'message' => 'Variant created Successfully!',
        ]);
    }

    //variant
    public function variantCreate()
    {
        $models = FeaturePhone::all();
        $brands = DB::table('brands')
            ->select('brands.*', 'categories.category_name')
            ->join('categories', 'brands.category_id', '=', 'categories.id')
            ->where('categories.id', '2')
            ->get();
        return view('backend/product/feature-phone/variant/variant-add', compact('models', 'brands'));
    }

    public function variantStore(Request $req)
    {
        $save_path = 'uploads/product/featurephone/variant/';

        foreach ($req->variantList as $variant) {
            // Log::info($variant);
            $newVariant = new FeaturePhoneVariant();
            $newVariant->brand_name = $variant['brand_name'];
            $newVariant->brand_id = $variant['brand_id'];
            $newVariant->model_id = $variant['model_id'];
            $newVariant->colour_name = $variant['colour_name'];
            $newVariant->colour_thumbnail = $save_path . $variant['colour_thumbnail'];
            $newVariant->front_image = $save_path . $variant['front_image'];
            $newVariant->back_image = $save_path . $variant['back_image'];
            // $newVariant->over_view_image = $save_path . $variant['over_view_image'];
            $newVariant->over_view_image_large = $save_path . $variant['over_view_image_large'];

            // $newVariant->subscriber_id = Auth::user()->subscriber_id;
            $newVariant->save();
        }
        return response()->json([
            'status' => 200,
            'message' => 'Variant created Successfully!',
        ]);
    }

    public function variantImgaeStore(Request $req)
    {
        $variant = new FeaturePhoneVariant();

        // if ($req->hasFile('colour_thumbnail')) {
        $file = $req->file('colour_thumbnail');

        $extension = $file->getClientOriginalExtension();

        $filename = $file->getClientOriginalName();
        // Log::info($filename);

        $save_path = 'uploads/product/featurephone/variant/';

        Image::make($file)
            ->resize(100, 100)
            ->save(public_path($save_path . $filename));
        $save_url = $save_path . $filename;

        $variant->colour_thumbnail = $save_url;


        // $file->move(public_path($save_path), $filename);
        // $save_url =  $save_path . $filename;

        // $variant->colour_thumbnail = $save_url;

        // }
        if ($req->hasFile('front_image')) {

            $file = $req->file('front_image');
            $extension = $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();
            $save_path = 'uploads/product/featurephone/variant/';

            // $file->move(public_path($save_path), $filename);
            Image::make($file)
                ->resize(167, 400)
                ->save(public_path($save_path . $filename));
            $save_url = $save_path . $filename;

            $variant->front_image = $save_url;
        }
        if ($req->hasFile('back_image')) {

            $file = $req->file('back_image');
            $extension = $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();
            $save_path = 'uploads/product/featurephone/variant/';

            // $file->move(public_path($save_path), $filename);
            Image::make($file)
                ->resize(167, 400)
                ->save(public_path($save_path . $filename));
            $save_url = $save_path . $filename;

            $variant->back_image = $save_url;
        }
        // if ($req->hasFile('over_view_image')) {

        //     // if($old_over_view_image !=''){
        //     //     unlink(public_path($old_over_view_image));
        //     //    }


        //     $file = $req->file('over_view_image');
        //     $extension = $file->getClientOriginalExtension();
        //     // $filename =$file->getClientOriginalName(). '.' . $extension;
        //     $filename = $file->getClientOriginalName();

        //     $save_path = 'uploads/product/featurephone/variant/';

        //     Image::make($file)
        //         ->resize(570, 570)
        //         ->save(public_path($save_path . $filename));
        //     // $file->move('uploads/product/featurephone/variant/', $filename);
        //     $save_url = 'uploads/product/featurephone/variant/' . $filename;

        //     $variant->over_view_image = $save_url;
        // }
        if ($req->hasFile('over_view_image_large')) {
            $file = $req->file('over_view_image_large');
            $extension = $file->getClientOriginalExtension();
            // $filename =$file->getClientOriginalName()  . '.' . $extension;
            $filename = $file->getClientOriginalName();

            $save_path = 'uploads/product/featurephone/variant/';
            if (!file_exists($save_path)) {
                // mkdir($save_path, 666, true);
                // Image::make($file)
                //     ->resize(570, 570)
                //     ->save(public_path($save_path . $filename));
                // $file->move(public_path('uploads/product/featurephone/variant/', $filename));
                $file->move(public_path($save_path), $filename);
                $save_url = 'uploads/product/featurephone/variant/' . $filename;

                $variant->over_view_image_large = $save_url;
            } else {
                // Image::make($file)
                //     ->resize(570, 570)  //442 600
                //     ->save(public_path($save_path . $filename));
                // $file->move('uploads/product/featurephone/variant/', $filename);.
                // $file->move(public_path($save_path), $filename);
                $file->move(public_path($save_path), $filename);
                $save_url = 'uploads/product/featurephone/variant/' . $filename;

                $variant->over_view_image_large = $save_url;
            }
        }
    }

    public function variantListView()
    {
        $data = DB::table('feature_phone_variants')
            ->select('feature_phones.model_name', 'brands.brand_name', 'feature_phone_variants.*')
            ->join('feature_phones', 'feature_phones.id', '=', 'feature_phone_variants.model_id')
            ->join('brands', 'brands.id', '=', 'feature_phone_variants.brand_id')
            ->get();
        return view('backend/product/feature-phone/variant/variant-list', compact('data'));
    }

    public function variantListData()
    {
        $data = DB::table('feature_phone_variants')
            ->select('feature_phones.model_name', 'feature_phone_variants.*')
            ->join('feature_phones', 'feature_phones.id', '=', 'feature_phone_variants.model_id')
            ->get();
        return $data;
    }

    public function variantEdit($id)
    {
        $models = FeaturePhone::all();
        $brands = DB::table('brands')
            ->select('brands.*', 'categories.category_name')
            ->join('categories', 'brands.category_id', '=', 'categories.id')
            ->where('categories.id', '2')
            ->get();
        $data = FeaturePhoneVariant::find($id);
        // return $data;
        return view('backend/product/feature-phone/variant/variant-edit', compact('data', 'brands', 'models'));
    }

    public function variantUpdate(Request $req, $id)
    {
        $variant = FeaturePhoneVariant::find($id);
        $variant->brand_id = $req->brand_id;
        $variant->brand_name = $req->brand_name;
        $variant->model_id = $req->model_id;
        $variant->colour_name = $req->colour_name;

        $old_colour_thumbnail = $req->old_colour_thumbnail;
        $old_front_image = $req->old_front_image;
        $old_back_image = $req->old_back_image;
        $old_over_view_image = $req->old_over_view_image;

        if ($req->hasFile('colour_thumbnail')) {

            if ($old_colour_thumbnail != '') {
                // unlink(public_path($old_colour_thumbnail));
            }

            $file = $req->file('colour_thumbnail');
            $extension = $file->getClientOriginalExtension();

            $filename = $file->getClientOriginalName();


            $save_path = 'uploads/product/featurephone/variant/';

            $file->move(public_path($save_path), $filename);
            $save_url =  $save_path . $filename;

            $variant->colour_thumbnail = $save_url;
        }
        if ($req->hasFile('front_image')) {

            if ($old_front_image != '') {
                // unlink(public_path($old_front_image));
            }

            $file = $req->file('front_image');
            $extension = $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();

            $save_path = 'uploads/product/featurephone/variant/';

            // $file->move(public_path($save_path), $filename);
            Image::make($file)
                ->resize(167, 400)
                ->save(public_path($save_path . $filename));
            $save_url =  $save_path . $filename;

            $variant->front_image = $save_url;
        }
        if ($req->hasFile('back_image')) {

            if ($old_back_image != '') {
                // unlink(public_path($old_back_image));
            }


            $file = $req->file('back_image');
            $extension = $file->getClientOriginalExtension();

            $filename = $file->getClientOriginalName();

            $save_path = 'uploads/product/featurephone/variant/';

            // $file->move(public_path($save_path), $filename);
            Image::make($file)
                ->resize(167, 400)
                ->save(public_path($save_path . $filename));
            $save_url = 'uploads/product/featurephone/variant/' . $filename;

            $variant->back_image = $save_url;
        }
        // if ($req->hasFile('over_view_image')) {

        //     if ($old_over_view_image != '') {
        //         // unlink(public_path($old_over_view_image));
        //     }


        //     $file = $req->file('over_view_image');
        //     $extension = $file->getClientOriginalExtension();
        //     // $filename =$file->getClientOriginalName(). '.' . $extension;
        //     $filename = $file->getClientOriginalName();

        //     $save_path = 'uploads/product/featurephone/variant/';

        //     Image::make($file)
        //         ->resize(570, 570)
        //         ->save(public_path($save_path . $filename));
        //     // $file->move('uploads/product/featurephone/variant/', $filename);
        //     $save_url = 'uploads/product/featurephone/variant/' . $filename;

        //     $variant->over_view_image = $save_url;
        // }
        if ($req->hasFile('over_view_image_large')) {
            $file = $req->file('over_view_image_large');
            $extension = $file->getClientOriginalExtension();
            // $filename =$file->getClientOriginalName()  . '.' . $extension;
            $filename = $file->getClientOriginalName();

            $save_path = 'uploads/product/featurephone/variant/';
            if (!file_exists($save_path)) {

                $file->move(public_path($save_path), $filename);
                $save_url = 'uploads/product/featurephone/variant/' . $filename;

                $variant->over_view_image_large = $save_url;
            } else {

                $file->move(public_path($save_path), $filename);
                $save_url = 'uploads/product/featurephone/variant/' . $filename;

                $variant->over_view_image_large = $save_url;
            }
        }
        $variant->save();
        $notification = [
            'message' => 'Variant Updated succesfull',
            'alert-type' => 'success',
        ];
        return redirect()
            ->back()
            ->with($notification);
    }
    public function variantDestroy($id)
    {
        $data = FeaturePhoneVariant::find($id);
        $colour_thumbnail = $data->colour_thumbnail;
        $front_image = $data->front_image;
        $back_image = $data->back_image;
        // $over_view_image = $data->back_image;
        $over_view_image_large = $data->back_image;

        // if ($colour_thumbnail != '') {
        //     unlink(public_path($colour_thumbnail));
        // }

        // if ($front_image != '') {
        //     unlink(public_path($front_image));
        // }

        // if ($back_image != '') {
        //     unlink(public_path($back_image));
        // }


        // if ($over_view_image_large != '') {
        //     unlink(public_path($over_view_image_large));
        // }

        FeaturePhoneVariant::find($id)->delete();
        $notification = [
            'message' => 'Variant Deleted succesfully',
            'alert-type' => 'warning',
        ];
        return redirect()
            ->back()
            ->with($notification);
    }

    //ajax
    public function getVariantImage($image)
    {
        $save_path = 'uploads/product/featurephone/variant/';
        $image_path = $save_path . $image;

        $data = DB::table('feature_phone_variants')
            ->select('front_image', 'back_image')
            ->where('colour_thumbnail', '=', $image_path)
            ->get();

        return response()->json([
            'status' => 200,
            'data' => $data,
        ]);
    }

    //ajax
    public function getOverViewImage($image)
    {
        $save_path = 'uploads/product/featurephone/variant/';
        $image_path = $save_path . $image;

        $data = DB::table('feature_phone_variants')
            ->select('over_view_image', 'over_view_image_large')
            ->where('colour_thumbnail', '=', $image_path)
            ->get();
        Log::info($data);
        return response()->json([
            'status' => 200,
            'data' => $data,
        ]);
    }

    //promo-slider
    public function sliderListView()
    {
        $sliders = ProductPromoSlider::latest()->get();
        return view('backend/product/feature-phone/slider/slider-index', compact('sliders'));
    }

    public function sliderCreate()
    {
        return view('backend/product/feature-phone/slider/slider-add');
    }

    public function sliderStore(Request $request)
    {
        $request->validate([
            'slider' => 'required',
        ]);
        $data = new ProductPromoSlider();

        $file = $request->file('slider');
        $extension = $file->getClientOriginalExtension();
        $filename = hexdec(uniqid()) . '.' . $extension;
        $save_path = 'uploads/product/featurephone/sliderimage/';
        if (!file_exists(public_path($save_path))) {
            // mkdir($save_path, 666, true);
            // Image::make($file)
            //     ->resize(1440, 600)
            //     ->save(public_path($save_path . $filename));
            $file->move(public_path($save_path, $filename));

            $save_url = 'uploads/product/featurephone/sliderimage/' . $filename;

            $data->slider = $save_url;
        } else {
            // Image::make($file)
            //     ->resize(1440, 600)
            //     ->save(public_path($save_path . $filename));
            // $file->move( $save_path, $filename);
            $file->move(public_path($save_path), $filename);
            $save_url = 'uploads/product/featurephone/sliderimage/' . $filename;

            $data->slider = $save_url;
        }

        $data->title = $request->title;
        $data->description = $request->description;
        $data->status = $request->status;

        $data->save();

        $notification = [
            'message' => 'Slider Added succesfull',
            'alert-type' => 'success',
        ];
        return redirect()
            ->route('feature.phone.slider.list.view')
            ->with($notification);
    }

    public function sliderEdit($id)
    {
        $data = ProductPromoSlider::find($id);
        return view('backend/product/feature-phone/slider/slider-edit', compact('data'));
    }

    public function sliderUpdate(Request $request, $id)
    {
        $data = ProductPromoSlider::find($id);
        $old_img = public_path($request->old_image);

        $data->title = $request->title;
        $data->description = $request->description;
        $data->status = $request->status;

        if ($request->hasFile('slider')) {
            // unlink($old_img);

            $file = $request->file('slider');
            $extension = $file->getClientOriginalExtension();
            $filename = hexdec(uniqid()) . '.' . $extension;
            $save_path = 'uploads/product/featurephone/sliderimage/';

            // Image::make($file)
            //     ->resize(1440, 600)
            //     ->save(public_path('uploads/product/featurephone/sliderimage/' . $filename));
            // $file->move( $save_path, $filename);
            $file->move(public_path($save_path), $filename);
            $save_url = 'uploads/product/featurephone/sliderimage/' . $filename;
            $data->slider = $save_url;
        }
        $data->save();

        $notification = [
            'message' => 'Slider Updated succesfully',
            'alert-type' => 'success',
        ];
        return redirect()
            ->route('feature.phone.slider.list.view')
            ->with($notification);
    }

    public function sliderDestroy($id)
    {
        $data = ProductPromoSlider::findOrFail($id);
        $img = $data->slider;
        // unlink(public_path($img));

        ProductPromoSlider::findOrFail($id)->delete();
        $notification = [
            'message' => 'slider deleted succesfully',
            'alert-type' => 'success',
        ];
        return redirect()
            ->back()
            ->with($notification);
    }
}
