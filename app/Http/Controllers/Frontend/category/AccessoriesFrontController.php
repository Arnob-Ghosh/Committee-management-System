<?php

namespace App\Http\Controllers\Frontend\category;

use App\Models\Accessory;
use App\Models\CareerLink;
use App\Models\FeaturePhone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AccessoriesCategory;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\AccessoriesPromoSlider;


class AccessoriesFrontController extends Controller
{
    public function accessoryList()
    {
        // $sliders = AccessoriesPromoSlider::all();
        $sliders = AccessoriesPromoSlider::Where('status','=',1)->get();
        $data = Accessory::with(['category'])->where('status', 1)->get();
        // Log::info(  $data );
        $feature_phone_overview_imgs = FeaturePhone::select('id', 'model_name', 'default_image')
            ->where('status', 1)
            ->latest()
            ->take(4)
            ->get();

        $category = DB::table('accessories_categories')
            ->distinct()
            ->select('accessories_categories.category_name')
            ->join('accessories', 'accessories.category_id', '=', 'accessories_categories.id')
            ->get();

        $brands = DB::table('brands')
            ->select('brands.*', 'categories.category_name')
            ->join('categories', 'brands.category_id', '=', 'categories.id')
            ->where('categories.category_name', 'Accosories')
            ->get();
        // return $data;
        $career_link = CareerLink::latest()->limit(1)->get();
        return view('frontend/category/accessories/accessories-list', compact('data', 'brands', 'sliders', 'category', 'feature_phone_overview_imgs', 'career_link'));
    }
    public function accessoryView($id)
    {
        $feature_phone_overview_imgs = FeaturePhone::select('id', 'model_name', 'default_image')
            ->where('status', 1)
            ->latest()
            ->take(4)
            ->get();
        $career_link = CareerLink::latest()->limit(1)->get();
        $data = Accessory::with(['category'])->where('id', '=', $id)
            ->where('status', 1)
            ->get();

        return view('frontend/category/accessories/accessories-view', compact('data',  'feature_phone_overview_imgs', 'career_link'));
    }

    public function getByCategory($categoryList)
    {
        $categoryListArr;

        if ($categoryList != 'null') {
            $categoryListArr = explode(',', $categoryList);
        } else {
            $categoryListArr = 'null';
        }

        if ($categoryListArr != 'null') {

            // $data = Accessory::with(['category' => function($q) {
            //     $q->whereIn('category_name', ['Headphone']);
            // }])->get();
            //    Log::info( $data);

            // $data = AccessoriesCategory::with(['accesory'])
            //     ->whereIn('category_name', $categoryListArr)
            //     ->get();
                $data =  AccessoriesCategory::with(['accesory'=>function($query){
                    $query->where('status', 1);
                  }])->whereIn('category_name', $categoryListArr)->get();

            return response()->json([
                'status' => 200,
                'data' => $data,
            ]);
        }
    }

    public function getByBrand($brand)
    {
        $data = Accessory::with(['category'])
            ->where('status', 1)
            ->where('brand_id', '=', $brand)
            ->get();

        return response()->json([
            'status' => 200,
            'data' => $data,
        ]);
    }
}
