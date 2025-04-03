<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\NoticeBoard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;
use File;
use Log;

class NewsBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $noticeBoards = NoticeBoard::all();
        return view('backend.mission_and_noticeboard.manage', compact('noticeBoards'));
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
            $noticeBoard = new NoticeBoard;

            $noticeBoard->title       = $request->title;
            $noticeBoard->long_desc   = $request->long_desc;
            $noticeBoard->role        = $request->role;
            $noticeBoard->status      = $request->status;

            if ($request->image) {                                                      // find img
                # code...
                // Delete Old Image
                if (File::exists('images/news/' . $noticeBoard->image)) {
                    # code...
                    File::delete('images/news/' . $noticeBoard->image);
                }

                $image = $request->file('image');                                      // received img
                $img = time() . '-br.' . $image->getClientOriginalExtension();        // make img name
                $location = public_path('images/news/' . $img);                  // find img location
                Image::make($image)->save($location);                               // save img location
                $noticeBoard->image = $img;                                               // save img
            }
            $noticeBoard->save();
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
        $noticeBoard = NoticeBoard::find($id);
        // log::info($user);
        return response()->json($noticeBoard);
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
            $noticeBoard = NoticeBoard::find($request->notice_id);
            Log::info($noticeBoard);

            $noticeBoard->title       = $request->title;
            $noticeBoard->long_desc   = $request->long_desc;
            $noticeBoard->role        = $request->role;
            $noticeBoard->status      = $request->status;

            if ($request->image) {                                                      // find img
                # code...
                // Delete Old Image
                if (File::exists('images/news/' . $noticeBoard->image)) {
                    # code...
                    File::delete('images/news/' . $noticeBoard->image);
                }

                $image = $request->file('image');                                      // received img
                $img = time() . '-br.' . $image->getClientOriginalExtension();        // make img name
                $location = public_path('images/news/' . $img);                  // find img location
                Image::make($image)->save($location);                               // save img location
                $noticeBoard->image = $img;                                               // save img
            } else {
                # code...
                $noticeBoard->image = $request->notice_img;
            }

            $noticeBoard->save();
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
		$noticeBoard = NoticeBoard::find($id);
        if (File::exists('images/news/' . $noticeBoard->image)) {
            # code...
            File::delete('images/news/' . $noticeBoard->image);
        }
		NoticeBoard::destroy($id);
        return response()->json([
            'status' => 200,
            'messages' => 'Deleted Successfully'
        ]);
    }
}
