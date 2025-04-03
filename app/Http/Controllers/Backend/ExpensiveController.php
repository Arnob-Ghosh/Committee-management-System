<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ExpensiveType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Log;

class ExpensiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expensiveTypes = ExpensiveType::all();
        return view('backend.expensive.manage', compact('expensiveTypes'));
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
            'expensive'  => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            # code...
            $expensiveType = new ExpensiveType;

            $expensiveType->name  = $request->expensive;

            $expensiveType->save();
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
        $expensiveType = ExpensiveType::find($id);
        // log::info($user);
        return response()->json($expensiveType);
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
            'expensive'       => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            # code...
            $expensiveType = ExpensiveType::find($request->expensiveType_id);
            Log::info($expensiveType);

            $expensiveType->name       = $request->expensive;
            $expensiveType->save();
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
		$expensiveType = ExpensiveType::find($id);

		ExpensiveType::destroy($id);
        return response()->json([
            'status' => 200,
            'messages' => 'Deleted Successfully'
        ]);
    }
}
