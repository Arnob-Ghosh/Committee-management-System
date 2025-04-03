<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Designation;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.designation.manage');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function fetchAll()
    {
        $designations = Designation::all();
        // Log::info($designations);
        $output = '';

        if ($designations->count() > 0) {
            $output .= '<table class="table table-bordered table-striped" id="designationTBL">
            <thead>
                <tr>
                    <th scope="col">#SL.</th>
                    <th scope="col">Designation Name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>';
            $i=1;
            foreach ($designations as $designation) {
                $output .= '<tr>
                    <td>' . $i . '</td>
                    <td>' . $designation->designation . '</td>
                    <td>
                        <a href="#" id="' . $designation->id . '" class="editIcon" data-bs-toggle="modal" data-bs-target="#editDesignationModal">
                            <i class="fas fa-edit" style="color: green"></i>
                        </a>

                        <a href="#" id="' . $designation->id . '" class="deleteIcon">
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
    public function store(Request $request)
    {
        // $request->validate(
        //     [
        //         'designation' => 'required|unique:designations',
        //     ],
        //     [
        //         'designation.required' => 'Designation is required',
        //         'designation.unique'   => 'Designation already exists',
        //     ]
        // );

        // $designation = new Designation;
        // $designation->designation = $request->designation;

        // $result = $designation->save();

        // if ($result) {
        //     # code...
        //     return response()->json([
        //         'message' => "Data Inserted Successfully",
        //         'code' => 200
        //     ]);
        // } else {
        //     # code...
        //     return response()->json([
        //         'message' => "Internal Server Error",
        //         'code' => 500
        //     ]);
        // }
        $designationData = [
            'designation' => $request->designation,
        ];

        Designation::create($designationData);
        return response()->json([
            'status' => 200,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $designations = Designation::all();

        if ($designations) {
            # code...
            return response()->json([
                'message' => "Data Found",
                'code' => 200,
                'data' => $designations,
            ]);
        } else {
            # code...
            return response()->json([
                'message' => "Internal Server Error",
                'code' => 500
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {

        $id = $request['id'];
        // log::info($request);
        $designation = Designation::find($id);

        return response()->json($designation);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $designation = Designation::find($request->designation_id);

        $designation->designation = $request->editDesignation;
        $designation->update();

        // log::info($request);

        return response()->json([
            'status' => 200,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
		$designation = Designation::find($id);
        Designation::destroy($id);
    }
}
