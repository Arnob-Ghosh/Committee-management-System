<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Thana;
use App\Models\Union;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UnionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unions = Union::orderBy('name', 'asc')->where('status', 1)->get();
        return view('backend.union.manage', compact('unions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $districts = District::orderBy('id', 'asc')->where('status', 1)->get();
        $thanas = Thana::orderBy('id', 'asc')->where('status', 1)->get();
        return view('backend.union.create', compact('districts', 'thanas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $union = new Union;

        $union->name           = $request->name;
        $union->slug           = Str::slug($request->name);
        $union->thana_id       = $request->thana_id;
        $union->district_id    = $request->district_id;
        $union->status         = $request->status;

        $union->save();
        $notification = array (
            'message' => 'Union Added Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('union.manage')->with($notification);
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
        $union = Union::find($id);
        $districts = District::orderBy('id', 'asc')->where('status', 1)->get();
        $thanas = Thana::orderBy('id', 'asc')->where('status', 1)->get();
        if( !is_null( $union ) ) {
            return view('backend.union.edit', compact('districts', 'thanas', 'union'));
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
        $union = Union::find($id);
        if( !is_null( $union ) ) {
            $union->name           = $request->name;
            $union->slug           = Str::slug($request->name);
            $union->district_id    = $request->district_id;
            $union->thana_id       = $request->thana_id;
            $union->status         = $request->status;

            $union->save();
            $notification = array (
                'message' => 'Union information Updated!',
                'alert-type' => 'info',
            );
            return redirect()->route('union.manage')->with($notification);
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
        $union = Union::find($id);
        if( !is_null( $union ) ) {
            // Image Deleted

            // Content Deleted
            // $brand->delete();

            // Soft Deleted
            $union->status = 0;
            $union->save();
            $notification = array (
                'message' => 'Union Removed Successfully!',
                'alert-type' => 'error',
            );
            return redirect()->route('union.manage')->with($notification);
        }
        else {
            // 404 Page not Found
        }
    }
}
