<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PhotoGallary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Log;
use File;
use Image;

class PhotoGallaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photoGallaries = PhotoGallary::all();
        return view('backend.gallary.manage', compact('photoGallaries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = [
            'gallary.required' => 'Image is required',
            'gallary.mimes' => 'Image types must be used png, jpg or jpeg formate.',
            // 'gallary.dimensions' => 'Image dimensions can be used to maximize width 600px and height 400px.',
        ];
        $validator = Validator::make($request->all(), [
            'gallary'  => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ], $message );

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            # code...
            $photoGallary = new PhotoGallary;


            if ($request->gallary) {                                                // find img
                # code...
                $gallary = $request->file('gallary');                                 // received img
                $img = time() . '-br.' . $gallary->getClientOriginalExtension();    // make img name
                $location = public_path('images/gallary/' . $img);                  // find img location

                $imgFile = Image::make($gallary);
                $imgFile->resize(600, 400, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($location);

                // Image::make($gallary)->save($location);                             // save img location
                $photoGallary->image  = $img;
            }

            $photoGallary->save();
            return response()->json([
                'status' => 200,
                'message' => "Added Successfully"
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request['id'];
        $photoGallary = PhotoGallary::find($id);
        // log::info($user);
        return response()->json($photoGallary);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Log::info($id);
        $message = [
            'gallary.mimes' => 'Image types must be used png, jpg or jpeg formate.',
            // 'gallary.dimensions' => 'Image dimensions can be used to maximize width 600px and height 400px.',
        ];
        $validator = Validator::make($request->all(), [
            'gallary'  => 'image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ], $message );

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            # code...
            $photoGallary = PhotoGallary::find($request->gallary_id);
            // Log::info($photoGallary);

            if ($request->gallary) {                                                // find img
                # code...
                // Delete Old Image
                if (File::exists('images/gallary/' . $photoGallary->image)) {
                    # code...
                    File::delete('images/gallary/' . $photoGallary->image);
                }

                $gallary = $request->file('gallary');                                 // received img
                $img = time() . '-br.' . $gallary->getClientOriginalExtension();    // make img name
                $location = public_path('images/gallary/' . $img);                  // find img location
                Image::make($gallary)->save($location);                             // save img location
                $photoGallary->image  = $img;
            } else {
                # code...
                $photoGallary->image = $request->gallary_img;
            }
            $photoGallary->save();
            return response()->json([
                'status' => 200,
                'message' => "Updated Successfully"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $photoGallary = PhotoGallary::find($request->id);
        // log::info($photoGallary);
        // Delete Old Image
        if (File::exists('images/gallary/' . $photoGallary->image)) {
            # code...
            File::delete('images/gallary/' . $photoGallary->image);
        }

		PhotoGallary::destroy($request->id);
        return response()->json([
            'status' => 200,
            'messages' => 'Deleted Successfully'
        ]);
    }
}
