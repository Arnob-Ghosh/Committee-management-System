<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BankUser;
use App\Models\MournMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Log;

class MournMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bankUsers = BankUser::where('member_id', '<>', null)->get();
        $mournMembers = MournMember::orderBy('id', 'desc')->get();
        // $mournMembers = DB::table('mourn_members')
        //     ->join('bank_users', 'mourn_members.member_id', '=', 'bank_users.member_id')
        //     ->select('bank_users.*', 'mourn_members.died_date')
        //     ->get();
        return view('backend.mourn_member.manage', compact('mournMembers', 'bankUsers'));
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
            'member_id'   => 'required|unique:mourn_members',
            'name'        => 'required',
            'mourn_date'  => 'required',
        ],[
            'member_id.required'  => 'Member ID is required',
            'member_id.unique'    => 'Member ID Already Exists',
            'name.required'       => 'Name is required',
            'mourn_date.required' => 'Dead Date is required',
        ]
    );

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            # code...
            $mournMember = new MournMember;

            $mournMember->member_id  = $request->member_id;
            $mournMember->name       = $request->name;
            $mournMember->died_date  = $request->mourn_date;
            BankUser::where('member_id','=',$request->member_id)->update(['status' => 0]);
            
            $mournMember->save();
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
        // Log::info($id);
        $mournMember = DB::table('mourn_members')->find($id);
        // $mournMember = MournMember::find($id);
        // log::info($mournMember);
        return response()->json($mournMember);
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
            'member_id'   => 'required',
            'name'        => 'required',
            'mourn_date'  => 'required',
        ],[
            'member_id.required'  => 'Member ID is required',
            'name.required'       => 'Name is required',
            'mourn_date.required' => 'Dead Date is required',
        ]
    );

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            # code...
            $mournMember = MournMember::find($request->mourn_id);
            // Log::info($expensiveType);

            $mournMember->member_id       = $request->member_id;
            $mournMember->name            = $request->name;
            $mournMember->died_date       = $request->mourn_date;
            BankUser::where('member_id','=',$request->member_id)->update(['status' => 0]);
            $mournMember->save();
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
		$mournMember = MournMember::find($id);

		MournMember::destroy($id);
        return response()->json([
            'status' => 200,
            'messages' => 'Deleted Successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function find(Request $request)
    {
        // Log::info($request);
        if( $request->member_id ){
            $member_info = BankUser::where('member_id', 'LIKE', '%'. $request->member_id .'%')->first();
            return response()->json($member_info);
            // return response()->json([
            //     'status' => 200,
            //     'member_info' => $member_info
            // ]);
        }
    }
}
