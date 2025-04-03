<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Thana;
use App\Models\Union;
use App\Models\JobSeeker;
use Log;

class JobSeekerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobSeekers = JobSeeker::orderBy('id', 'desc')->get();
        // Log::info($jobSeekers);
        return view('backend.jobSeeker.manage', compact('jobSeekers'));
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
        $jobSeeker = JobSeeker::find($request->jobSeeker_id);
        if( !is_null( $jobSeeker ) ) {
            $jobSeeker->comment       = $request->comment;
            $jobSeeker->status        = $request->status;

            $jobSeeker->save();
            $notification = array (
                'message' => 'Candidate Status Updated!',
                'alert-type' => 'info',
            );
            return redirect()->route('manage.jobSeeker')->with($notification);
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
        $jobSeeker = JobSeeker::find($id);
        if( !is_null( $jobSeeker ) ) {

            $jobSeeker->delete();
            $notification = array (
                'message' => 'Candidate Removed!',
                'alert-type' => 'error',
            );
            return redirect()->route('manage.jobSeeker')->with($notification);
        }
        else {
            // 404 Page not Found
        }

    }
}
