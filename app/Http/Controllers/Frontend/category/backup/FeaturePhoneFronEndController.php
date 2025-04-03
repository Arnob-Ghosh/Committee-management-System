<?php

namespace App\Http\Controllers\Frontend\category;

use Log;
use App\Models\Brand;

use App\Models\CareerLink;
use App\Models\FeaturePhone;
use Illuminate\Http\Request;
use App\Models\ProductPromoSlider;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\FeaturePhoneVariant;

use App\Http\Controllers\Controller;
use App\Models\FeaturePhoneDescription;
use App\Models\FeaturePhoneSpecificationCategory;

class FeaturePhoneFronEndController extends Controller
{
    public function featurePhoneList()
    {
        $sliders = ProductPromoSlider::Where('status','=',1)->get();
        $data = FeaturePhone::with(['feature_phone'])
            ->where('status', 1)
            ->get();
        // Log::info(  $data );
        $feature_phone_overview_imgs = FeaturePhone::select('id', 'model_name', 'default_image')
            ->where('status', 1)
            ->latest()
            ->take(4)
            ->get();

        $career_link = CareerLink::latest()->limit(1)->get();

        $camera = DB::table('feature_phones')
            ->distinct()
            ->select('camera')
            ->get();

        $display_size = DB::table('feature_phones')
            ->distinct()
            ->select('display_size')
            ->where('status', 1)
            ->get();
        $battery = DB::table('feature_phones')
            ->distinct()
            ->select('battery')
            ->where('status', 1)
            ->get();
        $network = DB::table('feature_phones')
            ->distinct()
            ->select('network_parameter')
            ->where('status', 1)
            ->get();
        $brands = DB::table('brands')
            ->select('brands.*', 'categories.category_name')
            ->join('categories', 'brands.category_id', '=', 'categories.id')
            ->where('categories.category_name', 'Feature Phone')
            ->get();
        // return $data;
        return view('frontend/category/feature-phone/feature-phone-list', compact('data', 'brands', 'sliders', 'camera', 'display_size', 'battery', 'network', 'feature_phone_overview_imgs', 'career_link'));
    }

    public function getDeviceByCamera($details)
    {
        if ($details == 'NA') {
            $details = 'N' . '/' . 'A';
            // Log::info( $details );
        }

        $data = FeaturePhone::with(['feature_phone'])
            ->where('status', 1)
            ->where('camera', '=', $details)
            ->get();
        $variant = DB::table('feature_phone_variants')
            ->select('feature_phone_variants.front_image', 'feature_phone_variants.model_id')
            ->join('feature_phones', 'feature_phones.id', '=', 'feature_phone_variants.model_id')
            ->where('feature_phones.camera', '=', $details)
            ->get();
        // Log::info($data);
        return response()->json([
            'status' => 200,
            'data' => $data,
            'variant' => $variant,
        ]);
    }

    public function getDeviceByBrand($details)
    {
        $data = FeaturePhone::with(['feature_phone'])
            ->where('brand_id', '=', $details)
            ->where('status', 1)
            ->get();

        return response()->json([
            'status' => 200,
            'data' => $data,
        ]);
    }
    public function getDeviceByDispaly($cameraList, $displayList, $batteryList, $networkList)
    {
        //    $display_sizes= $req->all();
        $cameraListArr;
        $displayListArr;
        $batteryListArr;
        $networkListArr;
        if ($cameraList != 'null') {
            $cameraListArr = explode(',', $cameraList);
        } else {
            $cameraListArr = 'null';
        }
        if ($displayList != 'null') {
            $displayListArr = explode(',', $displayList);
        } else {
            $displayListArr = 'null';
        }
        if ($batteryList != 'null') {
            $batteryListArr = explode(',', $batteryList);
        } else {
            $batteryListArr = 'null';
        }
        if ($networkList != 'null') {
            $networkListArr = explode(',', $networkList);
        } else {
            $networkListArr = 'null';
        }

        if ($cameraListArr != 'null' && $displayListArr != 'null' && $batteryListArr != 'null' && $networkListArr != 'null') {
            $data = FeaturePhone::with(['feature_phone'])
                ->whereIn('camera', $cameraListArr)
                ->whereIn('display_size', $displayListArr)
                ->whereIn('battery', $batteryListArr)
                ->whereIn('network_parameter', $networkListArr)
                ->where('status', 1)
                ->get();

            return response()->json([
                'status' => 200,
                'data' => $data,
            ]);
        } elseif ($cameraListArr != 'null' && $displayListArr != 'null' && $batteryListArr != 'null' && $networkListArr == 'null') {
            $data = FeaturePhone::with(['feature_phone'])
                ->whereIn('camera', $cameraListArr)
                ->whereIn('display_size', $displayListArr)
                ->whereIn('battery', $batteryListArr)
                ->where('status', 1)
                ->get();

            return response()->json([
                'status' => 200,
                'data' => $data,
            ]);
        } elseif ($cameraListArr != 'null' && $displayListArr != 'null' && $batteryListArr == 'null' && $networkListArr == 'null') {
            $data = FeaturePhone::with(['feature_phone'])
                ->whereIn('camera', $cameraListArr)
                ->whereIn('display_size', $displayListArr)
                ->where('status', 1)
                ->get();

            return response()->json([
                'status' => 200,
                'data' => $data,
            ]);
        } elseif ($cameraListArr != 'null' && $displayListArr == 'null' && $batteryListArr == 'null' && $networkListArr == 'null') {
            $data = FeaturePhone::with(['feature_phone'])
                ->whereIn('camera', $cameraListArr)
                ->where('status', 1)
                ->get();

            return response()->json([
                'status' => 200,
                'data' => $data,
            ]);
        } elseif ($cameraListArr == 'null' && $displayListArr != 'null' && $batteryListArr != 'null'  && $networkListArr != 'null') {
            $data = FeaturePhone::with(['feature_phone'])
                ->whereIn('display_size', $displayListArr)
                ->whereIn('battery', $batteryListArr)
                ->whereIn('network_parameter', $networkListArr)
                ->where('status', 1)
                ->get();

            return response()->json([
                'status' => 200,
                'data' => $data,
            ]);
        } elseif ($cameraListArr == 'null' && $displayListArr != 'null' && $batteryListArr == 'null' &&  $networkListArr == 'null') {
            $data = FeaturePhone::with(['feature_phone'])
                ->whereIn('display_size', $displayListArr)
                ->where('status', 1)
                ->get();

            return response()->json([
                'status' => 200,
                'data' => $data,
            ]);
        } elseif ($cameraListArr == 'null' && $displayListArr == 'null' && $batteryListArr != 'null' &&  $networkListArr == 'null') {
            $data = FeaturePhone::with(['feature_phone'])
                ->whereIn('battery', $batteryListArr)
                ->where('status', 1)
                ->get();

            return response()->json([
                'status' => 200,
                'data' => $data,
            ]);
        } elseif ($cameraListArr == 'null' && $displayListArr == 'null' && $batteryListArr == 'null' &&  $networkListArr != 'null') {
            $data = FeaturePhone::with(['feature_phone'])
                ->whereIn('network_parameter', $networkListArr)
                ->where('status', 1)
                ->get();
            //  Log::info($data);
            return response()->json([
                'status' => 200,
                'data' => $data,
            ]);
            //  upto this

        } elseif ($cameraListArr != 'null' && $displayListArr == 'null' && $batteryListArr != 'null' && $networkListArr != 'null') {
            $data = FeaturePhone::with(['feature_phone'])
                ->whereIn('camera', $cameraListArr)
                ->whereIn('battery', $batteryListArr)
                ->whereIn('network_parameter', $networkListArr)
                ->where('status', 1)
                ->get();

            return response()->json([
                'status' => 200,
                'data' => $data,
            ]);
        } elseif ($cameraListArr == 'null' && $displayListArr == 'null' && $batteryListArr != 'null' && $networkListArr != 'null') {
            $data = FeaturePhone::with(['feature_phone'])
                ->whereIn('battery', $batteryListArr)
                ->whereIn('network_parameter', $networkListArr)
                ->where('status', 1)
                ->get();

            return response()->json([
                'status' => 200,
                'data' => $data,
            ]);
        } elseif ($cameraListArr == 'null' && $displayListArr != 'null' && $batteryListArr == 'null' && $networkListArr != 'null') {
            $data = FeaturePhone::with(['feature_phone'])
                ->whereIn('display_size', $displayListArr)
                ->whereIn('network_parameter', $networkListArr)
                ->where('status', 1)
                ->get();

            return response()->json([
                'status' => 200,
                'data' => $data,
            ]);
        } elseif ($cameraListArr == 'null' && $displayListArr != 'null' && $batteryListArr != 'null' && $networkListArr == 'null') {
            $data = FeaturePhone::with(['feature_phone'])
                ->whereIn('display_size', $displayListArr)
                ->whereIn('battery', $batteryListArr)
                ->where('status', 1)
                ->get();

            return response()->json([
                'status' => 200,
                'data' => $data,
            ]);
        } elseif ($cameraListArr != 'null' && $displayListArr == 'null' && $batteryListArr != 'null' && $networkListArr == 'null') {
            $data = FeaturePhone::with(['feature_phone'])
                ->whereIn('camera', $cameraListArr)
                ->whereIn('battery', $batteryListArr)
                ->where('status', 1)
                ->get();

            return response()->json([
                'status' => 200,
                'data' => $data,
            ]);
        } elseif ($cameraListArr != 'null' && $displayListArr != 'null' && $batteryListArr == 'null' && $networkListArr != 'null') {
            $data = FeaturePhone::with(['feature_phone'])
                ->whereIn('camera', $cameraListArr)
                ->whereIn('display_size', $displayListArr)
                ->whereIn('network_parameter', $networkListArr)
                ->where('status', 1)
                ->get();

            return response()->json([
                'status' => 200,
                'data' => $data,
            ]);
        } elseif ($cameraListArr != 'null' && $displayListArr == 'null' && $batteryListArr == 'null' && $networkListArr != 'null') {
            $data = FeaturePhone::with(['feature_phone'])
                ->whereIn('camera', $cameraListArr)
                ->whereIn('network_parameter', $networkListArr)
                ->where('status', 1)
                ->get();

            return response()->json([
                'status' => 200,
                'data' => $data,
            ]);
        }
        //    $info= $details->toArray();

        //        $data = FeaturePhone::with(['feature_phone'])
        //        ->whereIn('camera', $cameraListArr)
        //        ->whereIn('display_size', $displayListArr)
        //        ->whereIn('battery', $batteryListArr)
        //        ->get();
        //         Log::info(  $data);
        //         return response()->json([
        //             'status' => 200,
        //             'data' => $data,
        //         ]);
    }

    public function featurePhoneViewUpdate($id)
    {
        $feature_phone_overview_imgs = FeaturePhone::select('id', 'model_name', 'default_image')
            ->where('status', 1)
            ->latest()
            ->take(4)
            ->get();
        $career_link = CareerLink::latest()->limit(1)->get();

        $data = FeaturePhone::with(['feature_phone'])
            ->where('id', '=', $id)
            ->get();

        $categories = DB::table('feature_phone_specification_categories')
            ->distinct()
            ->select('feature_phone_specification_categories.id', 'feature_phone_specification_categories.specificationCategory_name')
            ->join('feature_phone_descriptions', 'feature_phone_descriptions.category_id', '=', 'feature_phone_specification_categories.id')
            ->where('feature_phone_descriptions.model_id', '=', $id)
            ->get();

        $category_id = [];
        foreach ($categories as $category) {
            $category_id[] = $category->id;
        }
        // Log::info($category_id);
        // $data = FeaturePhone::with(['feature_phone'])
        //     ->whereIn('display_size', $category_id)
        //     ->get();

        foreach ($categories as $category) {
            // Log::info($category->id);
            $descriptions = DB::table('feature_phone_descriptions')
                ->select('feature_name', 'description')
                ->where('category_id', '=', $category->id)
                ->where('model_id', '=', $id)
                ->get();
            $arrayData = array_map(function ($item) {
                return (array) $item;
            }, $descriptions->toArray());

            $length = count($descriptions);
            // Log::info($descriptions);

            $coas = [
                'category_name' => $category->specificationCategory_name,
                'length' => $length,
                'details' => $arrayData,
                // 'parent_head_level' => $data->parent_head_level,
                // 'head_type' => $data->head_type,
                // 'is_transaction' => $data->is_transaction,
                // 'is_active' => $data->is_active,
                // 'is_general_ledger' => $data->is_general_ledger
            ];
            $data_arr[] = $coas;
        }

        // Log::info($data_arr);
        // $foo = collect([
        //             'data'    => $data_arr,
        //         ]);
        $k = json_encode($data_arr);
        $details = json_decode($k, true);
        Log::info($details);
        // foreach($k as $item){
        //     Log::info($item->category_name);
        // }
        // foreach($k as $member){

        // Log::info($details);
        // }

        // $details=$data_arr;

        // Log::info($k);
        // Log::info($data_arr);
        // dd($details);
        // return view('frontend/category/feature-phone/feature-phone-view', ['details' => $foo,'data' =>$data,'feature_phone_overview_imgs'=>$feature_phone_overview_imgs]);
        return view('frontend/category/feature-phone/feature-phone', compact('data', 'details', 'feature_phone_overview_imgs', 'career_link'));
        // view('your-view')->with('leads', json_decode($leads, true));
        // return View::make('frontend/category/feature-phone/feature-phone-view', [
        //     'details' => $details,
        //     'feature_phone_overview_imgs'=>$feature_phone_overview_imgs,
        //     'data'=>$data
        // ]);
        // view('your-view')->with('details', json_decode($data_arr, true))->with($data)->with($feature_phone_overview_imgs);
    }

    public function featurePhoneViewSpec($id)
    {
        $categories = DB::table('feature_phone_specification_categories')
            ->distinct()
            ->select('feature_phone_specification_categories.id', 'feature_phone_specification_categories.specificationCategory_name')
            ->join('feature_phone_descriptions', 'feature_phone_descriptions.category_id', '=', 'feature_phone_specification_categories.id')
            ->where('feature_phone_descriptions.model_id', '=', $id)
            ->get();
        foreach ($categories as $category) {
            // Log::info($category->id);
            $descriptions = DB::table('feature_phone_descriptions')
                ->select('feature_name', 'description')
                ->where('category_id', '=', $category->id)
                ->where('model_id', '=', $id)
                ->get();
            $arrayData = array_map(function ($item) {
                return (array) $item;
            }, $descriptions->toArray());

            $length = count($descriptions);
            // Log::info($descriptions);

            $coas = [
                'category_name' => $category->specificationCategory_name,
                'length' => $length,
                'details' => $arrayData,
                // 'parent_head_level' => $data->parent_head_level,
                // 'head_type' => $data->head_type,
                // 'is_transaction' => $data->is_transaction,
                // 'is_active' => $data->is_active,
                // 'is_general_ledger' => $data->is_general_ledger
            ];
            $data_arr[] = $coas;
        }
        return response()->json([
            'status' => 200,
            'data' => $data_arr,
        ]);
    }

    public function featurePhoneView($id)
    {
        $feature_phone_overview_imgs = FeaturePhone::select('id', 'model_name', 'default_image')
            ->where('status', 1)
            ->latest()
            ->take(4)
            ->get();

        $career_link = CareerLink::latest()->limit(1)->get();

        $finalArray = [];

        $descriptionArr = [];

        $categoryArr = [];

        $data = FeaturePhone::with(['feature_phone'])
            ->where('id', '=', $id)
            ->get();

        $over_view_images = DB::table('feature_phone_over_view_images')
            ->select('upper_image', 'lower_image')
            ->where('model_id', '=', $id)
            ->get();

        $descriptions = DB::table('feature_phone_descriptions')
            ->select('feature_name', 'description')
            ->where('model_id', '=', $id)
            ->get();

        foreach ($descriptions as $key => $value) {
            $descriptionArr[] = $value;
        }

        $categories = DB::table('feature_phone_specification_categories')
            ->distinct()
            ->select('feature_phone_specification_categories.specificationCategory_name')
            ->join('feature_phone_descriptions', 'feature_phone_descriptions.category_id', '=', 'feature_phone_specification_categories.id')
            ->get();

        foreach ($categories as $key => $value) {
            $categoryArr[] = $value;
        }

        // $length = count($descriptions);
        // Log::info($length);

        $finalArray = array_merge($categoryArr, $descriptionArr);
        // Log::info($finalArray);
        // $merged = json_encode($finalArray);
        //  $xx=[];
        //     $foo = collect([
        //         'category_name'    => $categories,
        //         'description' => $descriptions
        //     ]);
        //     foreach ($foo as $v ) {
        //         $xx[] = $v;

        //       }

        //     Log::info($xx);
        //     $merged = collect($categoryArr)->zip($descriptionArr)->transform(function ($values) {
        //         return [
        //             'category' => $values[0],
        //             'description' => $values[1],
        //         ];
        //     });
        //     $finalArray=$foo;
        // $f = json_encode($finalArray);
        $xy = [];
        $details = new Collection([
            'category_name' => $categories,
            'description' => $descriptions,
        ]);
        //    $phone_details= $details->toJson();

        // $xy[] = $foo;

        // $array = array_merge($categories->toArray(), $descriptions->toArray());

        //     $phone_details=json_encode($details);
        //     foreach ($details as $v ) {
        //                 $xy[] = $v;

        //    }

        // Log::info(json_encode($xy));
        // // $phone_details_arr=  $phone_details->toArray();
        // Log::info($xxx);
        $value = $id;
        $phone_details = FeaturePhoneSpecificationCategory::with([
            'feature_phone_description' => function ($q) use ($value) {
                // Query the name field in status table
                $q->where('model_id', '=', $value);
            },
        ])
            // ->whereHas('feature_phone_description', function($query) {
            //     $query->where('group_id', auth()->user()->group->id);
            //  })
            // ->select('feature_phone_specification_categories.*')
            //  ->join('feature_phone_descriptions', 'feature_phone_descriptions.feature_category', '=', 'feature_phone_specification_categories.id')
            // ->where('feature_phone_descriptions.model_id','=',$id)
            ->get();

        foreach ($phone_details as $item) {
            $g = count($item->feature_phone_description);
            if ($g > 0) {
                $d = $item->feature_phone_description;
                $len = [
                    'length' => $g,
                    'details' => $d,
                ];
                $length[] = $len;
                // $length[]=$g;
            }
        }



        return view('frontend/category/feature-phone/feature-phone-view-new', compact('data', 'descriptions', 'categories', 'phone_details', 'feature_phone_overview_imgs', 'over_view_images', 'career_link'));
    }

    public function getSpecification($id)
    {
        $categories = DB::table('feature_phone_specification_categories')
            ->distinct()
            ->select('feature_phone_specification_categories.id', 'feature_phone_specification_categories.specificationCategory_name')
            ->join('feature_phone_descriptions', 'feature_phone_specification_categories.id', '=', 'feature_phone_descriptions.category_id')
            ->where('feature_phone_descriptions.model_id', '=', $id)
            ->get();

        $category_id = [];
        foreach ($categories as $category) {
            $category_id[] = $category->id;
        }
        // $data = FeaturePhone::with(['feature_phone'])
        //     ->whereIn('display_size', $category_id)
        //     ->get();

        foreach ($categories as $category) {
            $descriptions = DB::table('feature_phone_descriptions')
                ->select('feature_name', 'description')
                ->where('category_id', '=', $category->id)
                ->where('model_id', '=', $id)
                ->get();
            $length = count($descriptions);
            $coas = [
                'category_name' => $category->specificationCategory_name,
                'length' => $length,
                'details' => $descriptions,
                // 'parent_head_level' => $data->parent_head_level,
                // 'head_type' => $data->head_type,
                // 'is_transaction' => $data->is_transaction,
                // 'is_active' => $data->is_active,
                // 'is_general_ledger' => $data->is_general_ledger
            ];
            $data_arr[] = $coas;

            // Log::info(json_encode($data_arr));
        }
        $info = json_encode($data_arr);
        // Log::info($category_id);
        // foreach($categories as $category){
        //     $coas = [
        //         'category_name' => $category->specificationCategory_name ,
        //         'parent' => $data->parent_head_level,
        //         'text' => $data->head_name,
        //         'icon' => 'fa fa-folder',
        //         // 'parent_head_level' => $data->parent_head_level,
        //         // 'head_type' => $data->head_type,
        //         // 'is_transaction' => $data->is_transaction,
        //         // 'is_active' => $data->is_active,
        //         // 'is_general_ledger' => $data->is_general_ledger
        //     ];

        //     $data_arr[] = $coas;
        // }
        // $descriptions = DB::table('feature_phone_descriptions')
        //     ->where('model_id', '=', $id)
        //     ->get();

        $descriptions = FeaturePhoneSpecificationCategory::with(['feature_phone_description'])
            //  ->select('feature_phone_specification_categories.specificationCategory_name','feature_phone_descriptions.*')
            //     ->join('feature_phone_descriptions', 'feature_phone_descriptions.category_id', '=', 'feature_phone_specification_categories.id')

            //             ->distinct()
            //         ->where('feature_phone_descriptions.model_id','=',$id)
            ->get();

        // $filtered = $itemCollection->where('specificationCategory_name', 'Main features');

        // $filtered->all();

        $itemCollection = collect($descriptions);
        $filtered = $itemCollection->filter(function ($item) use ($id) {
            foreach ($item->feature_phone_description as $a) {
                return stripos($a['model_id'], $id) !== false;
            }
        });
        $josn = $filtered->all();
        // Log::info($josn);
        //  $descriptions=FeaturePhoneDescription::with(['feature_phone_specification_category'])
        //          ->where('model_id','=',$id)
        //         ->get();

        return response()->json([
            'status' => 200,
            'data' => $data_arr,
        ]);
    }
}
