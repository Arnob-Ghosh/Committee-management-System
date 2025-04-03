<?php

namespace App\Http\Controllers\Frontend;

use Mail;
use App\Models\News;
use App\Models\Brand;
use App\Models\Slider;
use App\Models\AboutUs;
use App\Models\Contact;
use App\Models\Category;
use App\Models\Accessory;

use Illuminate\Http\Request;


use App\Models\ProductPromoSlider;
use App\Models\AccessoriesCategory;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;


use App\Models\AccessoriesPromoSlider;


class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status','=', 1)->get();
    //    log::info($sliders);
        $categories = Category::get();
        // $feature_phone_news = News::where('news_category', '=', 'Feature Phone')->latest()->limit(3)->get();
        // $feature_phone_news = News::latest()->limit(3)->get();
        // $brands = Brand::where('visiblity', '=',1)->get();
        // $feature_phone_overview_imgs = FeaturePhone::select('id', 'model_name', 'default_image')->where('status', 1)->latest()->take(4)->get();
        // $feature_promo_sliders = ExploreProductSlider::where('category_id',2)->get();
        //$smart_promo_sliders = ExploreProductSlider::where('category_id',1)->get();
        $accessories_promo_sliders = AccessoriesPromoSlider::where('status','=',1)->latest()->take(3)->get();
        // $career_link = CareerLink::latest()->limit(1)->get();
        return view('home', compact('sliders', 'categories', 'accessories_promo_sliders', ));
        // return view('frontview.pages.homepage');
    }
    public function col()
    {
        $News = News::get();
        return response()->json([
            'News' => $News,
            'status' => 200,
        ]);
    }
    public function highlight()
    {
        $News = News::where('highlight','=',1)->get();
        log::alert($News);
        return response()->json([
            'News' => $News,
            'status' => 200,
        ]);
    }
    public function cat()
    {
        $category = Category::get();
        return response()->json([
            'category' => $category,
            'status' => 200,
        ]);
    }

    public function search($id, $cat)
     {
        // log::alert($id);
        if($id=="")
        {
       $news = News::get();

        }
        if($cat==1)
        {
            $news = News::where('news_category', 'LIKE', '%' . $id . '%')->get();
        }
        else if($cat==2)
        {
            $news = News::where('accession_number', 'LIKE', '%' . $id . '%')->get();
        }
        else{
       $news = News::where('news_title', 'LIKE', '%' . $id . '%')->orWhere('news_category', 'LIKE', '%' . $id . '%')->get();
        }

       return response()->json([
        'News' => $news,
        'status' => 200,
    ]);
    }

    public function smartPhoneHomeProduct()
    {
        $feature_phone_overview_imgs = SmartPhone::select('id', 'model_name', 'default_image')->where('status', 1)->latest()->take(4)->get();
        return response()->json([
            'data' => $feature_phone_overview_imgs,
            'status' => 200,
        ]);
    }

    public function accessoriesHomeProduct()
    {
        $accessories = Accessory::select('id', 'product_name', 'default_image')->where('status', 1)->latest()->take(4)->get();
        return response()->json([
            'data' => $accessories,
            'status' => 200,
        ]);
    }

    public function smartPhoneHomePromoSlider()
    {
        $smart_promo_sliders = SmartPhonePromoSlider::all();
        return response()->json([
            'data' => $smart_promo_sliders,
            'status' => 200,
        ]);
    }

    public function accessoriesHomePromoSlider()
    {
        $accessories_promo_sliders = AccessoriesPromoSlider::all();
        return response()->json([
            'data' => $accessories_promo_sliders,
            'status' => 200,
        ]);
    }



    public function allNews()
    {
      //  $feature_phone_overview_imgs = FeaturePhone::select('id', 'model_name', 'default_image')->where('status', 1)->latest()->take(4)->get();
        $news = News::latest()->get();
       // $career_link = CareerLink::latest()->limit(1)->get();
        return view('frontend/news/news-all', compact('news'));
    }

    public function allcategories()
    {
        $news = News::latest()->get();

        return view('frontend/news/categories', compact('news'));
    }

      public function allexibition()
    {


        return view('frontend/news/all-exibition');
    }

    public function exibition()
    {
        $accessories_promo_sliders = AccessoriesPromoSlider::where('status','=',1)->latest()->get();
        Log::info($accessories_promo_sliders);
        return response()->json([
            'exibition' => $accessories_promo_sliders,
            'status' => 200,
        ]);

    }
    public function cat_News($cat)
    {
        $news = News::where('news_category',$cat)->get();
        $category= Category::where('category_name',$cat)->get();

        // log::info($category);
       // $career_link = CareerLink::latest()->limit(1)->get();
        return view('frontend/news/news-all', compact('news','category'));
    }

    public function detailsNews($id)
    {
        // $feature_phone_overview_imgs = FeaturePhone::select('id', 'model_name', 'default_image')->where('status', 1)->latest()->take(4)->get();
        $news = News::find($id);
        // $career_link = CareerLink::latest()->limit(1)->get();
        return view('frontend/news/news-details', compact('news'));
    }
    public function detailsExibition($id)
    {

        $accessories_promo_sliders = AccessoriesPromoSlider::find($id);
        return view('frontend/news/exibition-details',compact('accessories_promo_sliders'));
    }

    public function smartPhoneHomeNews()
    {
        $smart_phone_news = News::where('news_category', '=', 'Smart Phone')->latest()->limit(3)->get();
        return response()->json([
            'data' => $smart_phone_news,
            'status' => 200,
        ]);
    }

    public function accessoriesHomeNews()
    {
        $accessories_news = News::where('news_category', '=', 'Accessories')->latest()->limit(3)->get();
        return response()->json([
            'data' => $accessories_news,
            'status' => 200,
        ]);
    }

    public function categoryPhone()
    {
        return view('frontend/category/phone');
    }
    public function contactUs()
    {
        //$feature_phone_overview_imgs = FeaturePhone::select('id', 'model_name', 'default_image')->latest()->take(4)->get();
       // $career_link = CareerLink::latest()->limit(1)->get();

        return view('frontend/contact_us/contact-us');
    }

   public function aboutUs()
    {

        $about_us = AboutUs::latest()->limit(1)->get();
        $sliders = Slider::where('status','=', 1)->get();


        return view('frontend/about_us/about-us', compact( 'about_us','sliders'));
    }
    public function servicesWarrenty()
    {
        $feature_phone_overview_imgs = FeaturePhone::select('id', 'model_name', 'default_image')
            ->where('status', 1)
            ->latest()
            ->take(4)
            ->get();
        $services_warranty = ServiceWarranty::latest()->limit(1)->get();
        $career_link = CareerLink::latest()->limit(1)->get();

        return view('frontend/services-warranty/services-warranty', compact('feature_phone_overview_imgs', 'services_warranty', 'career_link'));
    }

    public function supportNservice()
    {
        $feature_phone_overview_imgs = FeaturePhone::select('id', 'model_name', 'default_image')
            ->where('status', 1)
            ->latest()
            ->take(4)
            ->get();
        $support_and_service = SupportAndService::latest()->limit(1)->get();
        $career_link = CareerLink::latest()->limit(1)->get();

        return view('frontend/support-and-service/support-and-service', compact('feature_phone_overview_imgs', 'support_and_service', 'career_link'));
    }

    public function warrantyPolicy()
    {
        $feature_phone_overview_imgs = FeaturePhone::select('id', 'model_name', 'default_image')
            ->where('status', 1)
            ->latest()
            ->take(4)
            ->get();
        $warranty_policy = WarrantyPolicy::latest()->limit(1)->get();
        $career_link = CareerLink::latest()->limit(1)->get();

        return view('frontend/warranty-policy/warranty-policy', compact('feature_phone_overview_imgs', 'warranty_policy', 'career_link'));
    }


    public function storeContactForm(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email',
        //     'phone' => 'required',
        //     'subject' => 'required',
        //     'message' => 'required',
        // ]);

        $contact = new Contact;

        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->phone = $request->phone;
        $contact->message = $request->message;

        // dd($contact);
        $contact->save();

        // Mail::send(
        //     'contact_email',
        //     array(
        //         'name' => $request->get('name'),
        //         'email' => $request->get('email'),
        //         'subject' => $request->get('subject'),
        //         'phone' => $request->get('phone'),

        //         'bodyMessage' => $request->get('message'),
        //     ),
        //     function ($message) use ($request) {
        //         $message->from($request->email);
        //         $message->to('info@amigo-bd.com')->subject($request->get('subject'));
        //     }
        // );


        return back()->with('success', 'Thank you for contact us!');
    }

    public function contactlist()
    {
        $contact=Contact::get();
        return view('backend/dynamic-pages/about-us/contact');
    }
    public function contactlistdata()
    {
        $contact=Contact::get();
        return response()->json([
            'data' => $contact,
            'status' => 200,
        ]);
    }

}
