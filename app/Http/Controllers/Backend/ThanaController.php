<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Thana;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ThanaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $thanas = Thana::orderBy('name', 'asc')->where('status', 1)->get();
        return view('backend.Thana.manage', compact('thanas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $districts = District::orderBy('id', 'asc')->where('status', 1)->get();
        return view('backend.thana.create', compact('districts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $thana = new Thana;

        $thana->name           = $request->name;
        $thana->slug           = Str::slug($request->name);
        $thana->district_id    = $request->district_id;
        $thana->status         = $request->status;

        $thana->save();
        $notification = array (
            'message' => 'Thana Added Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('thana.manage')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $thana = Thana::find($id);
        $districts = District::orderBy('id', 'asc')->where('status', 1)->get();
        if( !is_null( $thana ) ) {
            return view('backend.Thana.edit', compact('districts', 'thana'));
        }
        else {
            // 404 Page not Found
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $thana = Thana::find($id);
        if( !is_null( $thana ) ) {
            $thana->name           = $request->name;
            $thana->slug           = Str::slug($request->name);
            $thana->district_id    = $request->district_id;
            $thana->status         = $request->status;

            $thana->save();
            $notification = array (
                'message' => 'Thana information Updated!',
                'alert-type' => 'info',
            );
            return redirect()->route('thana.manage')->with($notification);
        }
        else {
            // 404 Page not Found
        }
    }

    /**
     * Display a listing of the resource.
     */
    // public function trash()
    // {
    //     $districts = District::orderBy('name', 'asc')->where('status', 0)->get();
    //     return view('backend.pages.district.trash', compact('districts'));
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $thana = Thana::find($id);
        if( !is_null( $thana ) ) {
            // Image Deleted

            // Content Deleted
            // $brand->delete();

            // Soft Deleted
            $thana->status = 0;
            $thana->save();
            $notification = array (
                'message' => 'Thana Removed Successfully!',
                'alert-type' => 'error',
            );
            return redirect()->route('thana.manage')->with($notification);
        }
        else {
            // 404 Page not Found
        }
    }
}
