<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\BloodGroupService;
use App\Models\BloodGroup;
use Log;

class BloodGroupController extends Controller
{
   protected $bloodGroupService;
    public function __construct(BloodGroupService $bloodGroupService){
        $this->bloodGroupService = $bloodGroupService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $bloodGroups = BloodGroup::all();
        return view('backend.bloodGroup.manage');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function fetchAll()
    {
        $bloodGroups = BloodGroup::all();
        $output = '';

        if ($bloodGroups->count() > 0) {
            $output .= '<table class="table table-bordered table-striped datatable">
            <thead>
                <tr>
                    <th scope="col">#SL.</th>
                    <th scope="col">Blood Group Name</th>
                    <th scope="col">Blood Group Sign</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>';
            $i=1;
            foreach ($bloodGroups as $bloodGroup) {
                $output .= '<tr>
                    <td>' . $i . '</td>
                    <td>' . $bloodGroup->blood_group . '</td>
                    <td>';
                    $output .= ($bloodGroup->blood_sign == 1) ? '<span class="badge bg-success">Positive</span>' : '<span class="badge bg-danger">Negative</span>';

                    $output .= '</td>
                    <td>
                        <a href="#" id="' . $bloodGroup->id . '" class="editIcon" data-bs-toggle="modal" data-bs-target="#editBloodGroupModal">
                            <i class="fas fa-edit" style="color: green"></i>
                        </a>

                        <a href="#" id="' . $bloodGroup->id . '" class="deleteIcon">
                            <i class="fas fa-trash" style="color: red"></i>
                        </a>
                    </td>
                </tr>';
                $i++;
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function addBloodGroup(Request $request)
    {
        // $bloodGroupData = [
        //     'blood_group' => $request->blood_group,
        //     'blood_sign'  => $request->blood_sign,
        // ];

        // BloodGroup::create($bloodGroupData);
        // return response()->json([
        //     'status' => 200,
        // ]);
        return $this->bloodGroupService->getAddBloodGroup($request);
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
    public function edit(Request $request)
    {
        // $id = $request['id'];
        // $bloodGroup = BloodGroup::find($id);
        // // log::info($bloodGroup);
        // return response()->json($bloodGroup);
        return $this->bloodGroupService->getEditBloodGroup($request);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // $bloodGroup = BloodGroup::find($request->blood_group_id);

        // $bloodGroup->blood_group = $request->edit_blood_group;
        // $bloodGroup->blood_sign = $request->edit_blood_sign;
        // $bloodGroup->update();

        // // log::info($request);

        // return response()->json([
        //     'status' => 200,
        // ]);
        return $this->bloodGroupService->getUpdatedBloodGroup($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
		$bloodGroup = BloodGroup::find($id);
        BloodGroup::destroy($id);
    }
}
