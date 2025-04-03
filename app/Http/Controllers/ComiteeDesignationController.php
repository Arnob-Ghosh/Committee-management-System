<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Advisor;
use App\Models\BankUser;
use App\Models\Designation;
use Illuminate\Http\Request;
use App\Models\CentralComitee;
use App\Models\DoharSubComitee;
use App\Models\ComiteeDesignation;
use Illuminate\Support\Facades\DB;
use App\Models\NawabganjSubComitee;
use App\Http\Controllers\Controller;

class ComiteeDesignationController extends Controller
{
    public function view()
    {
        $data=BankUser::all();

        return view('backend.bankUser.comitee_designation',compact('data'));
    }
    public function advisors_view()
    {
        $data=BankUser::all();

        return view('backend.bankUser.advisors',compact('data'));
    }

    public function add_new_member()
    {
        $data=BankUser::all();

        return view('backend.bankUser.add_new',compact('data'));
    }

    public function add_new_advisor()
    {
        $data=BankUser::all();
        $years=Advisor::distinct()->get('duration');

        return view('backend.bankUser.add_new_advisor',compact('data','years'));
    }
    public function edit_view()
    {
        $data=BankUser::all();
        return view('backend.bankUser.comitee_des_edit',compact('data'));
    }
    public function advisors_list()
    {
        $data=Advisor::distinct()->get('duration');
        return view('backend.bankUser.advisor_list',compact('data'));
    }
    public function comitee_get(Request $request)
    {
        if($request->comitee=='Dohar'){
            $duration=DoharSubComitee::distinct()->get('duration');
            return response()->json([
                'status' => 200,
                'comitee' => $duration
            ]);
        }
        else if($request->comitee=='Central'){
            $duration=CentralComitee::distinct()->get('duration');
            return response()->json([
                'status' => 200,
                'comitee' => $duration
            ]);
        }
        else if($request->comitee=='Nawabganj'){
            $duration=NawabganjSubComitee::distinct()->get('duration');
            return response()->json([
                'status' => 200,
                'comitee' => $duration
            ]);
        }

    }
    public function bankuser_info(Request $request)
    {
        // log::info($request);
        $data=BankUser::find($request->bankuser);
        if($data){
        return response()->json([
            'status' => 200,
            'data' => $data
        ]);
    }
    else
    {
        return response()->json([
            'status' => 400,
            'error'=>'data not found'

        ]);

    }
    }



    public function bankuser_info_edit(Request $request)
    {
        // log::info($request);
        $data=ComiteeDesignation::where([['comitee',$request->comitee],[]]);
        if($data){
        return response()->json([
            'status' => 200,
            'data' => $data
        ]);
    }
    else
    {
        return response()->json([
            'status' => 400,
            'error'=>'data not found'

        ]);


    }
}

    public function store_designation(Request $request)
    {

        // log::info($request);

        foreach($request->designations as $designation)
        {
            if($designation['comitee']=='Dohar'){
           $designations= new DoharSubComitee;
           $designations->name= $designation['name'];
           $designations->mobile_no= $designation['contact'];
           $designations->nid= $designation['nid'];
           $designations->designation= $designation['designation'];
           $designations->bank_name= $designation['bank'];
           $designations->comitee_designation= $designation['comitee_des'];
           $designations->comitee= $designation['comitee'];
           $designations->form= $designation['year1'];
           $designations->to_year=(int)$designation['year2'];
           $designations->duration=$designation['year1'] . '-' . (int)$designation['year2'];
           $duration=$designation['year1'] . '-' . (int)$designation['year2'];
           $designations->current=$designation['check'];
           $designations->member_id=$designation['member_id'];
           $designations->priority=$designation['priority'];
           if($designation['check']==1)
           {
               $current_comitees=NawabganjSubComitee::where('current',1)->first();
               if($current_comitees)
               $comitee=DB::statement("UPDATE dohar_sub_comitees SET current = 0 WHERE duration != ?", [$duration]);
           }

           $designations->save();


        }
        else if($designation['comitee']=='Central')
        {
            $designations= new CentralComitee;
           $designations->name= $designation['name'];
           $designations->mobile_no= $designation['contact'];
           $designations->nid= $designation['nid'];
           $designations->designation= $designation['designation'];
           $designations->bank_name= $designation['bank'];
           $designations->comitee_designation= $designation['comitee_des'];
           $designations->comitee= $designation['comitee'];
           $designations->form= $designation['year1'];
           $designations->to_year=(int)$designation['year2'];
           $designations->duration=$designation['year1'] . '-' . (int)$designation['year2'];
           $designations->current=$designation['check'];
           $designations->member_id=$designation['member_id'];
           $designations->priority=$designation['priority'];
           $duration=$designation['year1'] . '-' . (int)$designation['year2'];
           if($designation['check']==1)
           {
            $current_comitees=CentralComitee::where('current',1)->first();
            if($current_comitees)
            $comitee=DB::statement("UPDATE central_comitees SET current = 0 WHERE duration != ?", [$duration]);

           }


           $designations->save();


        }
        else if($designation['comitee']=='Nawabganj'){
            $designations= new NawabganjSubComitee;
            $designations->name= $designation['name'];
            $designations->mobile_no= $designation['contact'];
            $designations->nid= $designation['nid'];
            $designations->designation= $designation['designation'];
            $designations->bank_name= $designation['bank'];
            $designations->comitee_designation= $designation['comitee_des'];
            $designations->comitee= $designation['comitee'];
            $designations->form= $designation['year1'];
            $designations->to_year=(int)$designation['year2'];
            $designations->duration=$designation['year1'] . '-' . (int)$designation['year2'];
            $designations->current=$designation['check'];
            $designations->member_id=$designation['member_id'];
            $designations->priority=$designation['priority'];
            $duration=$designation['year1'] . '-' . (int)$designation['year2'];
            if($designation['check']==1)
            {
                $current_comitees=NawabganjSubComitee::where('current',1)->first();
                if($current_comitees)
                    $comitee=DB::statement("UPDATE nawabganj_sub_comitees SET current = 0 WHERE duration != ?", [$duration]);
    

            }



            $designations->save();


        }
        else{
            return response()->json([
                'status' => 400,
                'messsege'=>'something went wrong '

            ]);

        }



        }

        return response()->json([
            'status' => 200,
            'messsege'=>'successful'

        ]);


    }

    public function store_advisors(Request $request)
    {

        // log::info($request);

        foreach($request->advisors as $advisor)
        {
           $advisors= new Advisor;
           $advisors->name= $advisor['name'];
           $advisors->mobile_no= $advisor['contact'];
           $advisors->nid= $advisor['nid'];
           $advisors->designation= $advisor['designation'];
           $advisors->bank_name= $advisor['bank'];
           $advisors->form= $advisor['year1'];
           $advisors->to_year=(int)$advisor['year2'];
           $advisors->duration=$advisor['year1'] . '-' . (int)$advisor['year2'];
           $duration=$advisor['year1'] . '-' . (int)$advisor['year2'];
           $advisors->current=$advisor['check'];
           $advisors->member_id=$advisor['member_id'];
           $advisors->priority=$advisor['priority'];
           if($advisor['check']==1)
           {
            $comitee=DB::statement("UPDATE advisors SET current = 0 WHERE duration != ?", [$duration]);

           }

           $advisors->save();


        }
 
        return response()->json([
            'status' => 200,
            'messsege'=>'successful'

        ]);


    }
    public function advisor_priority_get(Request $request)
    {
     
         $advisor=Advisor::where([['duration',$request->duration]]) ->orderByDesc('priority')
         ->first();
         return response()->json([
             'status' => 200,
             'data'=>$advisor
 
         ]);
     }

   public function priority_get(Request $request)
   {
    if($request->comitee=='Nawabganj')
    {
        $designations=NawabganjSubComitee::where([['duration',$request->duration]]) ->orderByDesc('priority')
        ->first();
        return response()->json([
            'status' => 200,
            'data'=>$designations

        ]);
    }
    else if($request->comitee=='Dohar')
    {
        $designations=DoharSubComitee::where([['duration',$request->duration]]) ->orderByDesc('priority')
        ->first();

        return response()->json([
            'status' => 200,
            'data'=>$designations

        ]);

    }
    else if($request->comitee=='Central')
    {
        $designations=CentralComitee::where([['duration',$request->duration]])->orderByDesc('priority')
        ->first();
        return response()->json([
            'status' => 200,
            'data'=>$designations

        ]);
    }

   }

    public function advisors_list_data(Request $request)
    {
        if($request->duration)
            {
                $advisors=Advisor::with('bankUser')->where([['duration',$request->duration]])->get();
                return response()->json([
                    'status' => 200,
                    'data'=>$advisors

                ]);
            }
    }



    public function designation_list(Request $request)
    {
        if($request->comitee=='Nawabganj')
        {
            $designations=NawabganjSubComitee::where([['duration',$request->duration]])->get();
            return response()->json([
                'status' => 200,
                'data'=>$designations

            ]);
        }
        else if($request->comitee=='Dohar')
        {
            $designations=DoharSubComitee::where([['duration',$request->duration]])->get();

            return response()->json([
                'status' => 200,
                'data'=>$designations

            ]);

        }
        else if($request->comitee=='Central')
        {
            $designations=CentralComitee::where([['duration',$request->duration]])->get();
            return response()->json([
                'status' => 200,
                'data'=>$designations

            ]);
        }
        // else{
        //     $designations=CentralComitee::where('current',1)->get();
        //     return response()->json([
        //         'status' => 200,
        //         'data'=>$designations

        //     ]);

        // }



    }
    public function designation_get( $id)
    {


        $designation= Designation::find($id);
        if($designation)
        {
            return response()->json([
                'status' => 200,
                'designation'=>$designation->designation

            ]);
        }
        else
        {
            return response()->json([
                'status' => 400


            ]);

        }

    }

    public function advisors_list_edit(Request $request, $id)
    {

        $advisor=Advisor::find($id);
        return response()->json([
            'status' => 200,
            'data'=>$advisor

        ]);

        


    }
    public function designation_list_edit(Request $request, $id)
    {


        if($request->comitee=='Nawabganj')
        {
            $designations=NawabganjSubComitee::find($id);
            return response()->json([
                'status' => 200,
                'data'=>$designations

            ]);
        }
        else if($request->comitee=='Dohar')
        {
            $designations=DoharSubComitee::find($id);

            return response()->json([
                'status' => 200,
                'data'=>$designations

            ]);

        }
        else if($request->comitee=='Central')
        {
            $designations=CentralComitee::find($id);
            return response()->json([
                'status' => 200,
                'data'=>$designations

            ]);
        }
        else{
            return response()->json([
                'status' => 400,
                'error'=>'Something Went Wrong'

            ]);

        }

    }

    public function update_advisor(Request $request)
    {


        
        $designations=Advisor::find($request->id);
        $designations->name= $request->name;
        $designations->mobile_no= $request->mobileNumber;
        $designations->nid= $request->nid;
        $designations->designation= $request->designation;
        $designations->bank_name= $request->bankName;
        $designations->form= $request->form;
        $designations->to_year=$request->to;
        $designations->duration=$request->form . '-' . $request->to;
        $designations->priority=$request->priority;

        $designations->save();
        return response()->json([
            'status' => 200,
            'data'=>$designations

        ]);
        

    }
    public function update_designation(Request $request)
    {


        if($request->comitee=='Nawabganj')
        {
            $designations=NawabganjSubComitee::find($request->id);
            $designations->name= $request->name;
            $designations->mobile_no= $request->mobileNumber;
            $designations->nid= $request->nid;
            $designations->designation= $request->designation;
            $designations->bank_name= $request->bankName;
            $designations->comitee_designation= $request->committeeDesignation;
            $designations->comitee= $request->comitee;
            $designations->form= $request->form;
            $designations->to_year=$request->to;
            $designations->duration=$request->form . '-' . $request->to;
            $designations->priority=$request->priority;

            $designations->save();
            return response()->json([
                'status' => 200,
                'data'=>$designations

            ]);
        }
        else if($request->comitee=='Dohar')
        {
            $designations=DoharSubComitee::find($request->id);
            $designations->name= $request->name;
            $designations->mobile_no= $request->mobileNumber;
            $designations->nid= $request->nid;
            $designations->designation= $request->designation;
            $designations->bank_name= $request->bankName;
            $designations->comitee_designation= $request->committeeDesignation;
            $designations->comitee= $request->comitee;
            $designations->form= $request->form;
            $designations->to_year=$request->to;
            $designations->duration=$request->form . '-' . $request->to;
            $designations->priority=$request->priority;

            $designations->save();

            return response()->json([
                'status' => 200,
                'data'=>$designations

            ]);

        }
        else if($request->comitee=='Central')
        {
            $designations=CentralComitee::find($request->id);
            $designations->name= $request->name;
            $designations->mobile_no= $request->mobileNumber;
            $designations->nid= $request->nid;
            $designations->designation= $request->designation;
            $designations->bank_name= $request->bankName;
            $designations->comitee_designation= $request->committeeDesignation;
            $designations->comitee= $request->comitee;
            $designations->form= $request->form;
            $designations->to_year=$request->to;
            $designations->duration=$request->form . '-' . $request->to;
            $designations->priority=$request->priority;

            $designations->save();
            return response()->json([
                'status' => 200,
                'data'=>$designations

            ]);
        }
        else{
            return response()->json([
                'status' => 400,
                'error'=>'Something Went Wrong'

            ]);

        }

    }
    public function advisors_destroy($id)
    {
        $advisor=Advisor::find($id);
            if($advisor)
            $advisor->delete();

            return response()->json([
                'status' => 200,
            ]);
    }

    public function destroy(Request $request, $id){
        // log::info($id);
        // log::info($request);
        if($request->comitee=='Nawabganj')
        {
            $designations=NawabganjSubComitee::find($id);
            if($designations)
            $designations->delete();

            return response()->json([
                'status' => 200,
                // 'data'=>$designations

            ]);
        }
        else if($request->comitee=='Dohar')
        {
            $designations=DoharSubComitee::find($id);
            if($designations)
            $designations->delete();

            return response()->json([
                'status' => 200,
                // 'data'=>$designations

            ]);

        }
        else if($request->comitee=='Central')
        {
            $designations=CentralComitee::find($id);
            if($designations)
            $designations->delete();
            return response()->json([
                'status' => 200,
                // 'data'=>$designations

            ]);
        }
        else{
            return response()->json([
                'status' => 400,
                'error'=>'Something Went Wrong'

            ]);

        }



    }


}
