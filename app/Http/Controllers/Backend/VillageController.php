<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Thana;
use App\Models\Union;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VillageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $villages = Village::orderBy('name', 'asc')->get();
        return view('backend.village.manage', compact('villages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $thanas = Thana::orderBy('id', 'asc')->where('status', 1)->get();
        $unions = Union::orderBy('id', 'asc')->where('status', 1)->get();
        return view('backend.village.create', compact('thanas', 'unions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $village = new Village;

        $village->name           = $request->name;
        $village->slug           = Str::slug($request->name);
        $village->thana_id       = $request->thana_id;
        $village->union_id       = $request->union_id;
        $village->status         = $request->status;

        $village->save();
        $notification = array (
            'message' => 'Village Added Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('village.manage')->with($notification);
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
        $village = Village::find($id);
        $thanas = Thana::orderBy('id', 'asc')->where('status', 1)->get();
        $unions = Union::orderBy('id', 'asc')->where('status', 1)->get();
        if( !is_null( $village ) ) {
            return view('backend.village.edit', compact('village', 'thanas', 'unions'));
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
        $village = Village::find($id);
        if( !is_null( $village ) ) {
            $village->name           = $request->name;
            $village->slug           = Str::slug($request->name);
            $village->thana_id       = $request->thana_id;
            $village->union_id       = $request->union_id;
            $village->status         = $request->status;

            $village->save();
            $notification = array (
                'message' => 'Village Updated Successfully!',
                'alert-type' => 'success',
            );
            return redirect()->route('village.manage')->with($notification);
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
        $village = Village::find($id);
        if( !is_null( $village ) ) {
            // Image Deleted
            $village->delete();

            // Content Deleted
            // $village->delete();

            // Soft Deleted
            // $village->status = 0;
            // $village->save();
            $notification = array (
                'message' => 'Village Removed Successfully!',
                'alert-type' => 'error',
            );
            return redirect()->route('village.manage')->with($notification);
        }
        else {
            // 404 Page not Found
        }
    }
}
