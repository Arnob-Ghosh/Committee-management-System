<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Programme;
use App\Models\ProgrammeDate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Log;

class ProgrammeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programmes = Programme::groupBy('programme_name')->get();
        // Log::info($programmes);
        return view('backend.programme.manage', compact('programmes'));
    }

    public function listView(Request $request)
    {
        if( $request->programme_name ) {
            # code...
            $programmes = Programme::where('programme_name', 'LIKE', '%' . $request->programme_name . '%')->get();
            return response()->json($programmes);
        }
        else {
            // 404 Page not Found
        }
    }

    public function infoList()
    {
        $programmeDates = ProgrammeDate::orderBy('id', 'desc')->get();
        return response()->json(['data' => $programmeDates], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.programme.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Log::info($request);

        $validator = Validator::make($request->all(), [
            'programme_name'     => 'required',
            'applicant_name'     => 'required',
            'father_name'        => 'required',
            'union'              => 'required',
            'registration_fees'  => 'required',
            'phone'              => 'required|numeric|min:10',
            'participants_num'   => 'required',
        ],
        [
            'programme_name.required'        => 'Program Name is required',
            'applicant_name.required'        => 'Applicant Name is required',
            'father_name.required'           => 'Transaction ID is required',
            'union.required'                 => 'Union is required',
            'registration_fees.required'     => 'Registration Fees is required',
            'phone.required'                 => 'Phone No. is required',
            'participants_num.required'      => 'Total Participants Number is required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            # code...

            $programme = new Programme;

            $programme->programme_name         = $request->programme_name;
            $programme->start_date             = $request->start_date;
            $programme->end_date               = $request->end_date;
            $programme->applicant_name         = $request->applicant_name;
            $programme->father_name            = $request->father_name;
            $programme->unions                 = $request->union;
            $programme->registration_fees      = $request->registration_fees;
            $programme->phone                  = $request->phone;
            $programme->participants_num       = $request->participants_num;
            $programme->child_age1             = $request->child_age1;
            $programme->child_age2             = $request->child_age2;

            // Log::info($bankUser);
            $programme->save();
            return response()->json([
                'status' => 200,
                'message' => "Congratulations! Your Registration has been submitted successfully."
            ]);
        }

        // return $this->bankUserService->getAddBankUser($request);
    }

    public function infoStore(Request $request)
    {
        // Log::info($request);

        $validator = Validator::make($request->all(), [
            'programme_name'     => 'required',
            'start_date'         => 'required',
            'end_date'           => 'required',
            'status'             => 'required',
        ],
        [
            'programme_name.required'        => 'Programme Name is required',
            'start_date.required'            => 'Programme Start Date is required',
            'end_date.required'              => 'Programme End Date is required',
            'status.required'                => 'Status is required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            # code...

            $programmeDate = new ProgrammeDate;

            $programmeDate->programme_name         = $request->programme_name;
            $programmeDate->start_date             = $request->start_date;
            $programmeDate->end_date               = $request->end_date;
            $programmeDate->registration_fees      = $request->registration_fees;
            $programmeDate->status                 = $request->status;

            // Log::info($bankUser);
            $programmeDate->save();
            return response()->json([
                'status' => 200,
                'message' => "Info Added Successfully"
            ]);
        }

        // return $this->bankUserService->getAddBankUser($request);
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
        $programme = Programme::find($id);
        return response()->json($programme);
    }

    public function infoEdit(Request $request)
    {
        $id = $request['id'];
        $programmeDate = ProgrammeDate::find($id);
        return response()->json($programmeDate);
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

        $validator = Validator::make($request->all(), [
            'edit_programme_name'     => 'required',
            'edit_applicant_name'     => 'required',
            'edit_father_name'        => 'required',
            'edit_union'              => 'required',
            // 'edit_email'              => 'required|email|min:10',
            'edit_phone'              => 'required|numeric|min:10',
            'edit_participants_num'   => 'required',
        ],
        [
            'edit_programme_name.required'        => 'Program Name is required',
            'edit_applicant_name.required'        => 'Applicant Name is required',
            'edit_father_name.required'           => 'Transaction ID is required',
            'edit_union.required'                 => 'Union is required',
            // 'edit_email.required'                 => 'Email is required',
            'edit_phone.required'                 => 'Phone No. is required',
            'edit_participants_num.required'      => 'Total Participants Number is required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            $programme = Programme::find($request->programme_id);

            if( !is_null( $programme ) ) {

                $programme->programme_name         = $request->edit_programme_name;
                $programme->applicant_name         = $request->edit_applicant_name;
                $programme->father_name            = $request->edit_father_name;
                $programme->unions                 = $request->edit_union;
                // $programme->email                  = $request->edit_email;
                $programme->phone                  = $request->edit_phone;
                $programme->participants_num       = $request->edit_participants_num;
                $programme->child_age1             = $request->edit_child_age1;
                $programme->child_age2             = $request->edit_child_age2;

                $programme->save();

                return response()->json([
                    'status' => 200,
                    'message' => "Updated Successfully"
                ]);
            }
        }

        // return $this->bankUserService->getUpdatedBankUser($request);
    }

    public function infoUpdate(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'edit_programme_name'     => 'required',
            'edit_start_date'         => 'required',
            'edit_end_date'           => 'required',
            'edit_status'             => 'required',
        ],
        [
            'edit_programme_name.required'        => 'Programme Name is required',
            'edit_start_date.required'            => 'Programme Start Date is required',
            'edit_end_date.required'              => 'Programme End Date is required',
            'edit_status.required'                => 'Status is required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            $programmeDate = ProgrammeDate::find($request->programme_id);

            if( !is_null( $programmeDate ) ) {

                $programmeDate->programme_name         = $request->edit_programme_name;
                $programmeDate->start_date             = $request->edit_start_date;
                $programmeDate->end_date               = $request->edit_end_date;
                $programmeDate->registration_fees      = $request->edit_registration_fees;
                $programmeDate->status                 = $request->edit_status;

                $programmeDate->save();

                return response()->json([
                    'status' => 200,
                    'message' => "Updated Successfully"
                ]);
            }
        }

        // return $this->bankUserService->getUpdatedBankUser($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $programme = Programme::find($request->id);

		Programme::destroy($request->id);
        return response()->json([
            'status' => 200,
            'messages' => 'Deleted Successfully'
        ]);
    }

    public function infoDestroy(Request $request)
    {
        $programmeDate = ProgrammeDate::find($request->id);

		ProgrammeDate::destroy($request->id);
        return response()->json([
            'status' => 200,
            'messages' => 'Deleted Successfully'
        ]);
    }
}
