<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ExpensiveType;
use App\Models\ExpensiveAmount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Log;
use Auth;

class ExpensiveAmountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expensiveTypes = ExpensiveType::all();
        $expensiveAmounts = ExpensiveAmount::all();
        return view('backend.expensive_amount.manage', compact('expensiveTypes', 'expensiveAmounts'));
    }

    public function create()
    {
        $expensiveTypes = ExpensiveType::all();
        return view('backend.expensive_amount.create', compact('expensiveTypes'));
    }

    // public function yearlyReport(Request $request)
    // {
    //     $expensiveAmounts = ExpensiveAmount::all();
    //     return view('backend.expensive_amount.yearly_report', compact('expensiveAmounts'));
    // }

    public function yearlyReport(Request $request)
    {
        // Retrieve start and end dates from the request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Query ExpensiveAmount records based on the date range
        $expensiveAmounts = ExpensiveAmount::whereBetween('created_at', [$startDate, $endDate])->get();

        // Pass the filtered data to the view
        return view('backend.expensive_amount.yearly_report', compact('expensiveAmounts'));
    }

    // public function showYearlyReport(Request $request)
    // {
    //     if( $request->start_date && $request->end_date ) {
    //         # code...
    //         $yearly_reports = ExpensiveAmount::whereBetween('created_at', [$request->start_date, $request->end_date])->get();
    //         // Log::info($yearly_reports);
    //         return response()->json($yearly_reports);
    //     }
    //     else {
    //         // 404 Page not Found
    //     }
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'expensive.required'      => 'Expensive Type is required',
            'mode.required'           => 'Mode is required',
            'payment_type.required'   => 'Payment type is required',
            'amount.required'         => 'Amount is required',
            'remark.required'         => 'Remark is required',
            'date.required'           => 'payment Date is required',
        ];
        $validator = Validator::make($request->all(), [
            'expensive'         => 'required',
            'mode'              => 'required',
            'payment_type'      => 'required',
            'amount'            => 'required',
            'remark'            => 'required',
            'date'              => 'required',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            # code...
            $expensiveAmount = new ExpensiveAmount;

            $expensiveAmount->name      = $request->expensive;
            $expensiveAmount->mode      = $request->mode;
            if ($request->payment_type == 1) {
                # code...
                $expensiveAmount->cash_in   = $request->amount;
                $expensiveAmount->amount    = $request->amount - 0 ;
            } else {
                # code...
                $expensiveAmount->cash_out  = $request->amount;
                $expensiveAmount->amount    = 0 - $request->amount;
            }

            // $expensiveAmount->cash_in   = $request->cash_in;
            // $expensiveAmount->cash_out  = $request->cash_out;
            $expensiveAmount->remark       = $request->remark;
            $expensiveAmount->created_at   = $request->date;
            $expensiveAmount->entry_by     = Auth::user()->name;

            $expensiveAmount->save();
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
        $expensiveAmount = ExpensiveAmount::find($id);
        // log::info($user);
        return response()->json($expensiveAmount);
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
        $messages = [
            'edit_expensive.required' => 'Expensive Type is required',
            'edit_mode.required'      => 'Payment Mode is required',
            'edit_date.required'      => 'Date is required',
            'edit_cash_in.required'   => 'Cash in is required',
            'edit_cash_out.required'  => 'Cash out is required',
            'edit_remark.required'    => 'Remark is required',
        ];
        $validator = Validator::make($request->all(), [
            'edit_expensive'         => 'required',
            'edit_mode'              => 'required',
            'edit_date'              => 'required',
            'edit_cash_in'           => 'required',
            'edit_cash_out'          => 'required',
            'edit_remark'            => 'required',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            # code...
            $expensiveAmount = ExpensiveAmount::find($request->expensiveType_id);
            // Log::info($expensiveAmount);

            $expensiveAmount->name            = $request->edit_expensive;
            $expensiveAmount->mode            = $request->edit_mode;
            $expensiveAmount->created_at      = $request->edit_date;
            $expensiveAmount->amount          = $request->edit_cash_in - $request->edit_cash_out;
            $expensiveAmount->cash_in         = $request->edit_cash_in - $request->edit_cash_out;
            $expensiveAmount->cash_out        = $request->edit_cash_out;
            $expensiveAmount->remark          = $request->edit_remark;

            $expensiveAmount->save();
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
		// $expensiveAmount = ExpensiveAmount::find($id);

		ExpensiveAmount::destroy($id);
        return response()->json([
            'status' => 200,
            'messages' => 'Deleted Successfully'
        ]);
    }
}
