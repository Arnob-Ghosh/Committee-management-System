<?php

namespace App\Http\Services;
use App\Models\BloodGroup;

class bloodGroupService {

    public function getAddBloodGroup($request) {
        $bloodGroupData = [
            'blood_group' => $request->blood_group,
            'blood_sign'  => $request->blood_sign,
        ];

        BloodGroup::create($bloodGroupData);
        return response()->json([
            'status' => 200,
        ]);
    }

    public function getEditBloodGroup($request) {
        $id = $request['id'];
        $bloodGroup = BloodGroup::find($id);
        // log::info($bloodGroup);
        return response()->json($bloodGroup);
    }

    public function getUpdatedBloodGroup($request) {
        $bloodGroup = BloodGroup::find($request->blood_group_id);

        $bloodGroup->blood_group = $request->edit_blood_group;
        $bloodGroup->blood_sign = $request->edit_blood_sign;
        $bloodGroup->update();

        // log::info($request);

        return response()->json([
            'status' => 200,
        ]);
    }
}
