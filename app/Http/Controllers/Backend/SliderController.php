<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()->get();
        return view('backend/slider/slider-index', compact('sliders'));
    }

    public function createSlider()
    {
        return view('backend/slider/slider-add');
    }

    public function storeSlider(Request $request)
    {

        $request->validate([

            'slider' => 'required',
        ]);
        $data = new Slider;

        $file = $request->file('slider');
        $extension = $file->getClientOriginalExtension();
        $filename = hexdec(uniqid())  . '.' . $extension;
        $save_path='uploads/sliderimage/';

        // Image::make($file)->resize(1440, 600)->save(public_path('uploads/sliderimage/' . $filename));
        $file->move(public_path($save_path), $filename);
        $save_url = $save_path . $filename;
        // if (!file_exists($save_path)) {
        //     mkdir($save_path, 666, true);
        //     // Image::make($file)->resize(1440, 600)->save(public_path(  $save_path. $filename));
        //     $file->move( $save_path. $filename);
        //     $save_url = 'uploads/sliderimage/' . $filename;

        //     $data->slider = $save_url;
        // }
        // else{
        //     // Image::make($file)->resize(1440, 600)->save(public_path(  $save_path. $filename));
        //     // $file->move('uploads/sliderimage/', $filename);
        //     $file->move( $save_path. $filename);
        //     $save_url = 'uploads/sliderimage/' . $filename;

        //     $data->slider = $save_url;

        // }
        $data->slider = $save_url;
        $data->title      = $request->title;
        $data->slider_url      = $request->slider_url;
        $data->status      = $request->status;

        $data->save();

        $notification = array(
            'message' => 'Slider Added succesfull',
            'alert-type' => 'success'

        );
        return redirect()->route('slider.list.view')->with($notification);
    }

    public function editSlider($id)
    {
        $data = Slider::find($id);
        return view('backend/slider/slider-edit', compact('data'));
    }

    public function updateSlider(Request $request, $id)
    {
        $data = Slider::find($id);
        $old_img = public_path($request->old_image);

        $data->title      = $request->title;
        $data->slider_url      = $request->slider_url;
        $data->status      = $request->status;

        if ($request->hasFile('slider')) {

            // if($old_img !=''){
            //   unlink(public_path($old_img));
            // }


            $file = $request->file('slider');
            $extension = $file->getClientOriginalExtension();
            $filename = hexdec(uniqid())  . '.' . $extension;
            // Image::make($file)->resize(1440, 600)->save(public_path('uploads/sliderimage/' . $filename));
            $file->move(public_path('uploads/sliderimage/'), $filename);
            $save_url = 'uploads/sliderimage/' . $filename;
            $data->slider = $save_url;
        }
        $data->save();

        $notification = array(
            'message' => 'Slider Updated succesfully',
            'alert-type' => 'success'

        );
        return redirect()->route('slider.list.view')->with($notification);
    }

    public function destroySlider($id)
    {
        $data = Slider::findOrFail($id);
        $img = $data->slider;
        // if($img !=''){
        //      unlink(public_path($img));
        // }


        Slider::findOrFail($id)->delete();
        $notification = array(
            'message' => 'slider deleted succesfully',
            'alert-type' => 'success'

        );
        return redirect()->back()->with($notification);
    }
}
