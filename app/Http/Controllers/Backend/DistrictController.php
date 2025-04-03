<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $districts = District::orderBy('name', 'asc')->where('status', 1)->get();
        return view('backend.district.manage', compact('districts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $divisions = Division::orderBy('priority_num', 'asc')->where('status', 1)->get();
        return view('backend.district.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $district = new District;

        $district->name           = $request->name;
        $district->slug           = Str::slug($request->name);
        // $district->division_id    = $request->division_id;
        $district->status         = $request->status;

        $district->save();
        return redirect()->route('district.manage');
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
        $district = District::find($id);
        // $divisions = Division::orderBy('priority_num', 'asc')->where('status', 1)->get();
        if( !is_null( $district ) ) {
            return view('backend.district.edit', compact('district'));
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
        $district = District::find($id);
        if( !is_null( $district ) ) {
            $district->name           = $request->name;
            $district->slug           = Str::slug($request->name);
            // $district->division_id    = $request->division_id;
            $district->status         = $request->status;

            $district->save();
            return redirect()->route('district.manage');
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
    //     return view('backend.district.trash', compact('districts'));
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $district = District::find($id);
        if( !is_null( $district ) ) {
            // Image Deleted

            // Content Deleted
            // $brand->delete();

            // Soft Deleted
            $district->status = 0;
            $district->save();
            $notification = array (
                'message' => 'District Removed Successfully!',
                'alert-type' => 'error',
            );
            return redirect()->route('district.manage')->with($notification);
        }
        else {
            // 404 Page not Found
        }
    }
}
