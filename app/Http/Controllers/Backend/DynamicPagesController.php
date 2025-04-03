<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\AboutUs;
use App\Models\ServiceWarranty;
use App\Models\SupportAndService;
use App\Models\WarrantyPolicy;



class DynamicPagesController extends Controller
{
    //about us
    public function aboutUsListView()
    {

        return view('backend/dynamic-pages/about-us/about-us-list');
    }

    public function aboutUsStore(Request $req)
    {
        $messages = [
            'description.required' => 'Descriptione is required.',
        ];

        $validator = Validator::make(
            $req->all(),
            [
                'description' => 'required',
            ],
            $messages,
        );

        if ($validator->passes()) {
            $data = new AboutUs();
            $data->description = $req->description;
            $data->save();

            return response()->json([
                'status' => 200,
                'message' => 'Created successfully!',
            ]);
        }
        return response()->json(['error' => $validator->errors()]);
    }

    public function aboutUsListData(Request $req){
        $data = AboutUs::all();
        if($req -> ajax()){
            return response()->json([
                'data'=>$data,
            ]);
        }
    }

    public function aboutUsEdit($id){
        $data = AboutUs::find($id);

        if($data){
            return response()->json([
                'status'=>200,
                'data'=>$data,

            ]);
        }
    }

    public function aboutUsUpdate(Request $req, $id){

        $messages = [
            'description.required'  =>    "Description is required.",
        ];

        $validator = Validator::make($req->all(), [
            'description' => 'required',
        ], $messages);

        if ($validator->passes()) {
            $data = AboutUs::find($id);
            $data->description                 = $req->description;

        $data->save();

            return response() -> json([
                'status'=>200,
                'message' => 'Description updated successfully'
            ]);
        }

        return response()->json(['error'=>$validator->errors()]);

    }

    public function aboutUsDestroy($id){
        AboutUs::find($id)->delete($id);
        return response() -> json([
            'status'=>200,
            'message' => 'Description deleted successfully'
        ]);
        return redirect('about-us-list')->with('status', 'Deleted successfully!');
    }

      //service warranty
    public function serviceWarrantyListView()
    {

        return view('backend/dynamic-pages/service-warranty/service-warranty-list');
    }

    public function serviceWarrantyStore(Request $req)
    {
        $messages = [
            'description.required' => 'Descriptione is required.',
        ];

        $validator = Validator::make(
            $req->all(),
            [
                'description' => 'required',
            ],
            $messages,
        );

        if ($validator->passes()) {
            $data = new ServiceWarranty();
            $data->description = $req->description;
            $data->save();

            return response()->json([
                'status' => 200,
                'message' => 'Created successfully!',
            ]);
        }
        return response()->json(['error' => $validator->errors()]);
    }

    public function serviceWarrantyListData(Request $req){
        $data = serviceWarranty::all();
        if($req -> ajax()){
            return response()->json([
                'data'=>$data,
            ]);
        }
    }

    public function serviceWarrantyEdit($id){
        $data = ServiceWarranty::find($id);

        if($data){
            return response()->json([
                'status'=>200,
                'data'=>$data,

            ]);
        }
    }

    public function serviceWarrantyUpdate(Request $req, $id){

        $messages = [
            'description.required'  =>    "Description is required.",
        ];

        $validator = Validator::make($req->all(), [
            'description' => 'required',
        ], $messages);

        if ($validator->passes()) {
            $data = ServiceWarranty::find($id);
            $data->description                 = $req->description;

        $data->save();

            return response() -> json([
                'status'=>200,
                'message' => 'Description updated successfully'
            ]);
        }

        return response()->json(['error'=>$validator->errors()]);

    }


    public function serviceWarrantyDestroy($id){
        ServiceWarranty::find($id)->delete($id);
        return response() -> json([
            'status'=>200,
            'message' => 'Description deleted successfully'
        ]);
        return redirect('about-us-list')->with('status', 'Deleted successfully!');
    }


    //service warranty
    public function supportNserviceListView()
    {

        return view('backend/dynamic-pages/support-and-service/support-and-service-list');
    }

    public function supportNserviceStore(Request $req)
    {
        $messages = [
            'description.required' => 'Descriptione is required.',
        ];

        $validator = Validator::make(
            $req->all(),
            [
                'description' => 'required',
            ],
            $messages,
        );

        if ($validator->passes()) {
            $data = new SupportAndService();
            $data->description = $req->description;
            $data->save();

            return response()->json([
                'status' => 200,
                'message' => 'Created successfully!',
            ]);
        }
        return response()->json(['error' => $validator->errors()]);
    }

    public function supportNserviceListData(Request $req){
        $data = SupportAndService::all();
        if($req -> ajax()){
            return response()->json([
                'data'=>$data,
            ]);
        }
    }

    public function supportNserviceEdit($id){
        $data = SupportAndService::find($id);

        if($data){
            return response()->json([
                'status'=>200,
                'data'=>$data,

            ]);
        }
    }

    public function supportNserviceUpdate(Request $req, $id){

        $messages = [
            'description.required'  =>    "Description is required.",
        ];

        $validator = Validator::make($req->all(), [
            'description' => 'required',
        ], $messages);

        if ($validator->passes()) {
            $data = SupportAndService::find($id);
            $data->description                 = $req->description;

        $data->save();

            return response() -> json([
                'status'=>200,
                'message' => 'Description updated successfully'
            ]);
        }

        return response()->json(['error'=>$validator->errors()]);

    }


    public function supportNserviceDestroy($id){
        SupportAndService::find($id)->delete($id);
        return response() -> json([
            'status'=>200,
            'message' => 'Description deleted successfully'
        ]);
        return redirect('about-us-list')->with('status', 'Deleted successfully!');
    }

//warranty-policy
    public function warrantyPolicyListView()
    {

        return view('backend/dynamic-pages/warranty-policy/warranty-policy-list');
    }

    public function warrantyPolicyStore(Request $req)
    {
        $messages = [
            'description.required' => 'Descriptione is required.',
        ];

        $validator = Validator::make(
            $req->all(),
            [
                'description' => 'required',
            ],
            $messages,
        );

        if ($validator->passes()) {
            $data = new WarrantyPolicy();
            $data->description = $req->description;
            $data->save();

            return response()->json([
                'status' => 200,
                'message' => 'Created successfully!',
            ]);
        }
        return response()->json(['error' => $validator->errors()]);
    }

    public function warrantyPolicyListData(Request $req){
        $data = WarrantyPolicy::all();
        if($req -> ajax()){
            return response()->json([
                'data'=>$data,
            ]);
        }
    }

    public function warrantyPolicyEdit($id){
        $data = WarrantyPolicy::find($id);

        if($data){
            return response()->json([
                'status'=>200,
                'data'=>$data,

            ]);
        }
    }

    public function warrantyPolicyUpdate(Request $req, $id){

        $messages = [
            'description.required'  =>    "Description is required.",
        ];

        $validator = Validator::make($req->all(), [
            'description' => 'required',
        ], $messages);

        if ($validator->passes()) {
            $data = WarrantyPolicy::find($id);
            $data->description                 = $req->description;

        $data->save();

            return response() -> json([
                'status'=>200,
                'message' => 'Description updated successfully'
            ]);
        }

        return response()->json(['error'=>$validator->errors()]);

    }


    public function warrantyPolicyDestroy($id){
        WarrantyPolicy::find($id)->delete($id);
        return response() -> json([
            'status'=>200,
            'message' => 'Description deleted successfully'
        ]);
        return redirect('about-us-list')->with('status', 'Deleted successfully!');
    }
}
