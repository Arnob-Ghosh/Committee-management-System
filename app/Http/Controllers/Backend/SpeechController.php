<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Speech;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;
use File;
use Log;

class SpeechController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $speeches = Speech::all();
        return view('backend.speech.manage', compact('speeches'));
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
        $validator = Validator::make($request->all(), [
            'title'       => 'required',
            'long_desc'   => 'required',
            'role'        => 'required',
            'image'       => 'mimes:jpg,png,jpeg|image',
            'status'      => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            # code...
            $speech = new Speech;

            $speech->title       = $request->title;
            $speech->long_desc   = $request->long_desc;
            $speech->role        = $request->role;
            $speech->status      = $request->status;

            if ($request->image) {                                                      // find img
                # code...
                // Delete Old Image
                if (File::exists('images/news/' . $speech->image)) {
                    # code...
                    File::delete('images/news/' . $speech->image);
                }

                $image = $request->file('image');                                      // received img
                $img = time() . '-br.' . $image->getClientOriginalExtension();        // make img name
                $location = public_path('images/news/' . $img);                  // find img location
                Image::make($image)->save($location);                               // save img location
                $speech->image = $img;                                               // save img
            }
            $speech->save();
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
        $speech = Speech::find($id);
        // log::info($user);
        return response()->json($speech);
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
        $validator = Validator::make($request->all(), [
            'title'       => 'required',
            'long_desc'   => 'required',
            'role'        => 'required',
            'image'       => 'mimes:jpg,png,jpeg',
            'status'      => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            # code...
            $speech = Speech::find($request->speech_id);
            Log::info($speech);

            $speech->title       = $request->title;
            $speech->long_desc   = $request->long_desc;
            $speech->role        = $request->role;
            $speech->status      = $request->status;

            if ($request->image) {                                                      // find img
                # code...
                // Delete Old Image
                if (File::exists('images/news/' . $speech->image)) {
                    # code...
                    File::delete('images/news/' . $speech->image);
                }

                $image = $request->file('image');                                      // received img
                $img = time() . '-br.' . $image->getClientOriginalExtension();        // make img name
                $location = public_path('images/news/' . $img);                  // find img location
                Image::make($image)->save($location);                               // save img location
                $speech->image = $img;                                               // save img
            } else {
                # code...
                $speech->image = $request->speech_img;
            }

            $speech->save();
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
        $id = $request->id;
        // log::info($id);
		$speech = Speech::find($id);
        if (File::exists('images/news/' . $speech->image)) {
            # code...
            File::delete('images/news/' . $speech->image);
        }
		Speech::destroy($id);
        return response()->json([
            'status' => 200,
            'messages' => 'Deleted Successfully'
        ]);
    }
}
