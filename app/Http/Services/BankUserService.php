<?php

namespace App\Http\Services;
use App\Models\BankUser;
use App\Models\BloodGroup;
use App\Models\Designation;
use File;
use Image;
use Log;

class bankUserService {

    public function getAddBankUser($request) {
        if ($request->image) {                                                // find img
            # code...
            $image = $request->file('image');                                 // received img
            $img = time() . '-br.' . $image->getClientOriginalExtension();    // make img name
            $location = public_path('images/user/' . $img);                  // find img location
            Image::make($image)->save($location);                             // save img location
        }

        $bankUserData = [
            'name'               => $request->name,
            'email'              => $request->email,
            'contact'            => $request->contact,
            'bank_name'          => $request->bank_name,
            'designation_id'     => $request->designation,
            'blood_group_id'     => $request->blood_group,
            'present_address'    => $request->present_address,
            'permanent_address'  => $request->permanent_address,
            'status'             => $request->status,
            'image'              => $img,
        ];

        BankUser::create($bankUserData);
        return response()->json([
            'status' => 200,
        ]);
    }

    public function getUpdatedBankUser($request) {
        $bankUser = BankUser::find($request->bank_user_id);
        // log::info($bankUser);

		if ($request->edit_images) {                                                // find img
            # code...
            // Delete Old Image
            if (File::exists('images/user/' . $bankUser->image)) {
                # code...
                File::delete('images/user/' . $bankUser->image);
            }

            $image = $request->file('edit_images');                              // received img
            // log::info($image);
            $img = time() . '-br.' . $image->getClientOriginalExtension();       // make img name
            // log::info($img);
            $location = public_path('images/user/' . $img);                      // find img location
            Image::make($image)->save($location);                                // save img location
            $bankUser->image = $img;                                             // save img
            // log::info($bankUser->image);
        }

        $bankUser->name              = $request->edit_name;
        $bankUser->email             = $request->edit_email;
        $bankUser->contact           = $request->edit_contact;
        $bankUser->bank_name         = $request->edit_bank_name;
        $bankUser->designation_id    = $request->edit_designation;
        $bankUser->blood_group_id    = $request->edit_blood_group;
        $bankUser->present_address   = $request->edit_present_address;
        $bankUser->permanent_address = $request->edit_permanent_address;
        $bankUser->status            = $request->edit_status;

        $bankUser->update();

        return response()->json([
            'status' => 200,
        ]);
    }
}

