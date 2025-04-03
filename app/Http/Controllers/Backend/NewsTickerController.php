<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsTicker;
use File;
use Image;

class NewsTickerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newsTickers = NewsTicker::orderBy('id', 'desc')->get();
        return view('backend.newsTicker.manage', compact('newsTickers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.newsTicker.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newsTicker = new NewsTicker;

        if ($request->image) {                                                // find img
            # code...
            $image = $request->file('image');                                 // received img
            $img = time() . '-br.' . $image->getClientOriginalExtension();    // make img name
            $location = public_path('images/news/' . $img);                  // find img location
            Image::make($image)->save($location);                             // save img location
            $newsTicker->image = $img;
        }

        $newsTicker->short_desc           = $request->short_desc;
        $newsTicker->long_desc            = $request->long_desc;
        $newsTicker->headline             = $request->headline;
        $newsTicker->speech_role          = $request->speech_role;
        $newsTicker->status               = $request->status;

        $newsTicker->save();
        $notification = array (
            'message' => 'News Ticker Added Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('news.ticker.manage')->with($notification);
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
    public function edit($id)
    {
        $newsTicker = NewsTicker::find($id);
        if( !is_null( $newsTicker ) ) {
            return view('backend.newsTicker.edit', compact('newsTicker'));
        }
        else {
            // 404 Page not Found
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $newsTicker = NewsTicker::find($id);
        if( !is_null( $newsTicker ) ) {
            $newsTicker->short_desc           = $request->short_desc;
            $newsTicker->long_desc            = $request->long_desc;
            $newsTicker->headline             = $request->headline;
            $newsTicker->speech_role          = $request->speech_role;
            $newsTicker->status               = $request->status;

            if ($request->image) {                                                // find img
                # code...
                // Delete Old Image
                if (File::exists('images/news/' . $newsTicker->image)) {
                    # code...
                    File::delete('images/news/' . $newsTicker->image);
                }

                $image = $request->file('image');                                 // received img
                $img = time() . '-br.' . $image->getClientOriginalExtension();    // make img name
                $location = public_path('images/news/' . $img);                  // find img location
                Image::make($image)->save($location);                             // save img location
                $newsTicker->image = $img;                                             // save img
            }

            $newsTicker->save();
            $notification = array (
                'message' => 'News Ticker information Updated!',
                'alert-type' => 'info',
            );
            return redirect()->route('news.ticker.manage')->with($notification);
        }
        else {
            // 404 Page not Found
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $newsTicker = NewsTicker::find($id);
        if( !is_null( $newsTicker ) ) {
            // Image Deleted
            if (File::exists('images/news/' . $newsTicker->image)) {
                # code...
                File::delete('images/news/' . $newsTicker->image);
            }

            // Content Deleted
            $newsTicker->delete();

            // Soft Deleted
            // $newsTicker->status = 0;
            // $newsTicker->save();
            $notification = array (
                'message' => 'News Ticker Removed Successfully!',
                'alert-type' => 'error',
            );
            return redirect()->route('news.ticker.manage')->with($notification);
        }
        else {
            // 404 Page not Found
        }
    }
}
