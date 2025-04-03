<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PhotoLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Log;

class PhotoLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photoLinks = PhotoLink::all();
        return view('backend.photo-link.manage', compact('photoLinks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'title.required'            => 'Photo Title is required',
            'title.unique'              => 'Photo Title Already Exists',
            'date.required'             => 'Date is required',
            'photo_link.required'       => 'Photo Drive Link is required',
        ];
        $validator = Validator::make($request->all(), [
            'title'            => 'required|unique:photo_links|max:30',
            'date'             => 'required',
            'photo_link'       => 'required',
        ], $messages );

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            # code...
            $photoLink = new PhotoLink;


            $photoLink->title      = $request->title;
            $photoLink->date       = $request->date;
            $photoLink->photo_link = $request->photo_link;

            $photoLink->save();
            return response()->json([
                'status' => 200,
                'message' => "Added Successfully"
            ]);
        }
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
        $photoLink = PhotoLink::find($id);
        // log::info($user);
        return response()->json($photoLink);
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
        $messages = [
            'title.required'            => 'Photo Title is required',
            'title.unique'              => 'Photo Title Already Exists',
            'date.required'             => 'Date is required',
            'photo_link.required'       => 'Photo Drive Link is required',
        ];
        $validator = Validator::make($request->all(), [
            'title'            => 'required|unique:photo_links,title,' . $request->photo_id . '|max:30',
            'date'             => 'required',
            'photo_link'       => 'required',
        ], $messages );

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            # code...
            $photoLink = PhotoLink::find($request->photo_id);
            // Log::info($photoGallary);
            $photoLink->title      = $request->title;
            $photoLink->date       = $request->date;
            $photoLink->photo_link = $request->photo_link;

            $photoLink->save();
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
        // $photoLink = PhotoLink::find($request->id);
        // log::info($photoGallary);

		PhotoLink::destroy($request->id);
        return response()->json([
            'status' => 200,
            'messages' => 'Deleted Successfully'
        ]);
    }
}
