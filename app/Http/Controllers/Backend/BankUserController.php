<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Designation;
use App\Models\BloodGroup;
use App\Models\District;
use App\Models\Thana;
use App\Models\Union;
use App\Models\Village;
use App\Models\BankUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\BankUserService;
use Illuminate\Support\Facades\Hash;
use File;
use Image;
use Log;
use Auth;
use DB;

class BankUserController extends Controller
{
    protected $bankUserService;
    public function __construct(BankUserService $bankUserService) {
        $this->bankUserService = $bankUserService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $designations = Designation::orderBy('designation', 'asc')->get();
        $bloodGroups = BloodGroup::orderBy('blood_group', 'asc')->get();
        $bankUsers = BankUser::orderBy('id', 'desc')->where('status', 1)->orWhere('status', 0)->get();
        return view('backend.bankUser.manage', compact('designations', 'bloodGroups', 'bankUsers'));
    }

    /**
     * Display a listing of the resource.
     */
    public function pending()
    {
        $designations = Designation::orderBy('designation', 'asc')->get();
        $bloodGroups = BloodGroup::orderBy('blood_group', 'asc')->get();
        $bankUsers = BankUser::orderBy('id', 'asc')->where('status', 2)->get();
        return view('backend.bankUser.pending_resgistration', compact('designations', 'bloodGroups', 'bankUsers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $designations = Designation::orderBy('designation', 'asc')->get();
        $thanas = Thana::orderBy('name', 'asc')->get();
        $unions = Union::orderBy('name', 'asc')->get();
        $villages = Village::orderBy('name', 'asc')->get();
        return view('backend.bankUser.create', compact('designations', 'thanas', 'unions', 'villages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Log::info($request);

        $validator = Validator::make($request->all(), [
            'name'               => 'required',
            'email'              => 'required|unique:bank_users|email|min:10',
            'contact'            => 'required|numeric',
            'father_name'        => 'required|max:255',
            'mother_name'        => 'required|max:255',
            'spouse_name'        => 'required|max:255',
            'birth_date'         => 'required|max:20',
            'nationality'        => 'required|max:20',
            'national_id'        => 'required|max:20',
            'religion'           => 'required|max:20',
            'bank_name'          => 'required|max:255',
            'designation_id'     => 'required|max:255',
            'blood_group'        => 'required|max:30',
            'district'           => 'required|max:255',
            'thana_id'           => 'required|max:200',
            'union_id'           => 'required|max:200',
            'village_id'         => 'required|max:200',
            'post_office'        => 'required|max:200',
            'branch'             => 'required|max:255',
            'section'            => 'required|max:255',
            'facebook_id'        => 'required|max:255',
            // 'present_address'    => 'required|max:20',
            'status'             => 'required',
            'image'              => 'required',
        ],
        [
            'name.required'             => 'Name is required',
            'email.required'            => 'Email is required',
            'email.unique'              => 'Email Already Exists',
            'bank_name.required'        => 'Bank Name is required',
            'father_name.required'      => 'Father Name is required',
            'mother_name.required'      => 'Mother Name is required',
            'spouse_name.required'      => 'Spouse Name is required',
            'birth_date.required'       => 'Date of Birth is required',
            'nationality.required'      => 'Nationality is required',
            'national_id.required'      => 'National ID is required',
            'religion.required'         => 'Religion is required',
            'contact.required'          => 'Contact Number is required',
            'contact.min'               => ' Contact Number must be at least 11 digits.',
            'designation_id.required'   => 'Designation is required',
            'blood_group.required'      => 'Blood Group is required',
            // 'present_address.required'  => 'Present Address is required',
            'district.required'         => 'District is required',
            'thana_id.required'         => 'Upzila is required',
            'union_id.required'         => 'Union is required',
            'village_id.required'       => 'Village is required',
            'branch.required'           => 'Branch is required',
            'section.required'          => 'Section is required',
            'post_office.required'      => 'Post Office is required',
            'facebook_id.required'      => 'Facebook ID is required',
            'status.required'           => 'Status is required',
            'image.required'            => 'Image is required',
        ]
    );

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            # code...

            $bankUser = new BankUser;

            $bankUser->name               = $request->name;
            $bankUser->email              = $request->email;
            $bankUser->contact            = $request->contact;
            $bankUser->father_name        = $request->father_name;
            $bankUser->mother_name        = $request->mother_name;
            $bankUser->spouse_name        = $request->spouse_name;
            $bankUser->birth_date         = $request->birth_date;
            $bankUser->nationality        = $request->nationality;
            $bankUser->nid                = $request->national_id;
            $bankUser->religion           = $request->religion;
            $bankUser->designation_id     = $request->designation_id;
            $bankUser->blood_group        = $request->blood_group;
            $bankUser->district           = $request->district;
            $bankUser->thana_id           = $request->thana_id;
            $bankUser->union_id           = $request->union_id;
            $bankUser->village_id         = $request->village_id;
            $bankUser->post_office        = $request->post_office;
            $bankUser->bank_name          = $request->bank_name;
            $bankUser->branch             = $request->branch;
            $bankUser->section            = $request->section;
            $bankUser->facebook_id        = $request->facebook_id;
            // $bankUser->present_address    = $request->present_address;
            $bankUser->status             = $request->status;


            if ($request->image) {                                                // find img
                # code...
                $image = $request->file('image');                                 // received img
                $img = time() . '-br.' . $image->getClientOriginalExtension();    // make img name
                $location = public_path('images/user/' . $img);                   // find img location

                $imgFile = Image::make($image);
                $imgFile->resize(206, 206, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($location);                                              // resize & img location

                // Image::make($image)->save($location);                          // save img location
                $bankUser->image  = $img;
            }

            // Log::info($bankUser);
            $bankUser->save();
            return response()->json([
                'status' => 200,
                'message' => "Bank User Added Successfully"
            ]);
        }

        // return $this->bankUserService->getAddBankUser($request);
    }

    public function edit(Request $request)
    {
        $id = $request['id'];
        $bankUser = BankUser::find($id);

        $bankUser->thana_name=$bankUser->thana->name;
        $bankUser->union_name=$bankUser->union->name;
        $bankUser->village_name=$bankUser->village->name;
        // $bankUser->designation_name = $bankUser->designation->designation;
        return response()->json($bankUser);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name'                => 'required',
            'member_id'           => 'required|unique:bank_users,member_id,' . $request->bankUser_id,
            'email'               => 'required|unique:bank_users,email,' . $request->bankUser_id . '|email|min:10',
            'contact'             => 'required',
            'father_name'         => 'required|max:255',
            'mother_name'         => 'required|max:255',
            'spouse_name'         => 'required|max:255',
            'birth_date'          => 'required|max:20',
            'nationality'         => 'required|max:20',
            'national_id'         => 'required|max:20|unique:bank_users,nid,' . $request->bankUser_id,
            'religion'            => 'required|max:20',
            'bank_name'           => 'required|max:255',
            'designation_id'      => 'required|max:255',
            'comitee_designation' => 'required|max:255',
            'blood_group'         => 'required|max:20',
            'district'            => 'required|max:255',
            'thana_id'            => 'required|max:20',
            'union_id'            => 'required|max:20',
            'village_id'          => 'required|max:20',
            'post_office'         => 'required|max:255',
            'branch'              => 'required|max:255',
            'section'             => 'required|max:255',
            'facebook_id'         => 'required|max:255',
            // 'present_address'     => 'required|max:20',
            'status'              => 'required',
            'image'               => 'mimes:jpg,png,jpeg',
            ],
            [
                'name.required'                  => 'Name is required',
                'member_id.required'             => 'Member ID is required',
                'member_id.unique'               => 'Member ID Already Exists',
                'email.required'                 => 'Email is required',
                'email.unique'                   => 'Email Already Exists',
                'bank_name.required'             => 'Bank Name is required',
                'father_name.required'           => 'Father Name is required',
                'mother_name.required'           => 'Mother Name is required',
                'spouse_name.required'           => 'Spouse Name is required',
                'birth_date.required'            => 'Date of Birth is required',
                'nationality.required'           => 'Nationality is required',
                'national_id.required'           => 'National ID is required',
                'religion.required'              => 'Religion is required',
                'contact.required'               => 'Contact Number is required',
                'contact.min'                    => ' Contact Number must be at least 11 digits.',
                'designation_id.required'        => 'Designation is required',
                'comitee_designation.required'   => 'Comitee Designation is required',
                'transaction_id.required'        => 'Transaction ID is required',
                'blood_group.required'           => 'Blood Group is required',
                // 'present_address.required'       => 'Present Address is required',
                'district.required'              => 'District is required',
                'thana_id.required'              => 'Upzila is required',
                'union_id.required'              => 'Union is required',
                'village_id.required'            => 'Village is required',
                'branch.required'                => 'Branch is required',
                'section.required'               => 'Section is required',
                'post_office.required'           => 'Post Office is required',
                'facebook_id.required'           => 'Facebook ID is required',
                'image.required'                 => 'Image is required',
                'signature.required'             => 'Signature is required',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            $bankUser = BankUser::find($request->bankUser_id);

            if ($request->image) {                                                // find img
                # code...
                // Delete Old Image
                if (File::exists('images/user/' . $bankUser->image)) {
                    # code...
                    File::delete('images/user/' . $bankUser->image);
                }

                $image = $request->file('image');                                 // received img
                $img = time() . '-br.' . $image->getClientOriginalExtension();    // make img name
                $location = public_path('images/user/' . $img);                   // find img location
                
                $imgFile = Image::make($image);
                $imgFile->resize(206, 206, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($location);                                              // resize & img location
                
                // Image::make($image)->save($location);                          // save img location
                $bankUser->image = $img;                                          // save img
            } else {
                # code...
                $bankUser->image = $request->bankUser_img;
            }
            if( !is_null( $bankUser ) ) {

                $bankUser->member_id              = $request->member_id;
                $bankUser->name                   = $request->name;
                $bankUser->email                  = $request->email;
                $bankUser->contact                = $request->contact;
                $bankUser->mobile                = $request->mobile;
                $bankUser->father_name            = $request->father_name;
                $bankUser->mother_name            = $request->mother_name;
                $bankUser->spouse_name            = $request->spouse_name;
                $bankUser->birth_date             = $request->birth_date;
                $bankUser->nationality            = $request->nationality;
                $bankUser->nid                    = $request->national_id;
                $bankUser->religion               = $request->religion;
                $bankUser->designation_id         = $request->designation_id;
                $bankUser->comitee_designation    = $request->comitee_designation;
                $bankUser->blood_group            = $request->blood_group;
                $bankUser->district               = $request->district;
                $bankUser->thana_id               = $request->thana_id;
                $bankUser->union_id               = $request->union_id;
                $bankUser->village_id             = $request->village_id;
                $bankUser->post_office            = $request->post_office;
                $bankUser->bank_name              = $request->bank_name;
                $bankUser->branch                 = $request->branch;
                $bankUser->section                = $request->section;
                $bankUser->facebook_id            = $request->facebook_id;
                $bankUser->present_address        = $request->present_address;
                $bankUser->status                 = $request->status;

                $bankUser->save();

                // $bankUserData = [
                //     'name'               => $request->name,
                //     'email'              => $request->email,
                //     'contact'            => $request->contact,
                //     'father_name'        => $request->father_name,
                //     'mother_name'        => $request->mother_name,
                //     'spouse_name'        => $request->spouse_name,
                //     'birth_date'         => $request->birth_date,
                //     'nationality'        => $request->nationality,
                //     'national_id'        => $request->national_id,
                //     'religion'           => $request->religion,
                //     'designation_id'     => $request->designation_id,
                //     'blood_group'        => $request->blood_group,
                //     'district'           => $request->district,
                //     'thana_id'           => $request->thana_id,
                //     'union_id'           => $request->union_id,
                //     'village_id'         => $request->village_id,
                //     'post_office'        => $request->post_office,
                //     'bank_name'          => $request->bank_name,
                //     'branch'             => $request->branch,
                //     'section'            => $request->section,
                //     'facebook_id'        => $request->facebook_id,
                //     'present_address'    => $request->present_address,
                //     'status'             => $request->status,
                //     'image'              => $img,
                // ];
                // BankUser::where('id', $request->bankUser_id)->update($bankUserData);
                return response()->json([
                    'status' => 200,
                    'message' => "User Updated Successfully"
                ]);
            }
        }

        // return $this->bankUserService->getUpdatedBankUser($request);
    }

    /**
     * Update the specified resource in storage.
     */
    public function pendingUserUpdate(Request $request)
    {
        log::info($request);
        $validator = Validator::make($request->all(), [
            'name'                => 'required',
            // 'member_id'           => 'required|unique:bank_users,member_id,' . $request->bankUser_id,
            'email'               => 'required|unique:bank_users,email,' . $request->bankUser_id . '|email|min:10',
            'contact'             => 'required',
            'father_name'         => 'required|max:255',
            'mother_name'         => 'required|max:255',
            'spouse_name'         => 'required|max:255',
            'birth_date'          => 'required|max:20',
            'nationality'         => 'required|max:20',
            'national_id'         => 'required|max:20|unique:bank_users,nid,' . $request->bankUser_id,
            'religion'            => 'required|max:20',
            'bank_name'           => 'required|max:255',
            'designation_id'      => 'required|max:255',
            'comitee_designation' => 'required|max:255',
            'blood_group'         => 'required|max:20',
            'district'            => 'required|max:255',
            'thana_id'            => 'required|max:20',
            'union_id'            => 'required|max:20',
            'village_id'          => 'required|max:20',
            'post_office'         => 'required|max:255',
            'branch'              => 'required|max:255',
            'section'             => 'required|max:255',
            'facebook_id'         => 'required|max:255',
            // 'present_address'     => 'required|max:20',
            'status'              => 'required',
            'image'               => 'image|mimes:jpg,png,jpeg',
            ],
            [
                'name.required'                  => 'Name is required',
                'member_id.required'             => 'Member ID is required',
                // 'member_id.unique'               => 'Member ID Already Exists',
                'email.required'                 => 'Email is required',
                'email.unique'                   => 'Email Already Exists',
                'bank_name.required'             => 'Bank Name is required',
                'father_name.required'           => 'Father Name is required',
                'mother_name.required'           => 'Mother Name is required',
                'spouse_name.required'           => 'Spouse Name is required',
                'birth_date.required'            => 'Date of Birth is required',
                'nationality.required'           => 'Nationality is required',
                'national_id.required'           => 'National ID is required',
                'national_id.unique'           => 'National ID should be unique',
                'religion.required'              => 'Religion is required',
                'contact.required'               => 'Contact Number is required',
                // 'contact.min'                    => ' Contact Number must be at least 11 digits.',
                'designation_id.required'        => 'Designation is required',
                'comitee_designation.required'   => 'Comitee Designation is required',
                'transaction_id.required'        => 'Transaction ID is required',
                'blood_group.required'           => 'Blood Group is required',
                // 'present_address.required'       => 'Present Address is required',
                'district.required'              => 'District is required',
                'thana_id.required'              => 'Upzila is required',
                'union_id.required'              => 'Union is required',
                'village_id.required'            => 'Village is required',
                'branch.required'                => 'Branch is required',
                'section.required'               => 'Section is required',
                'post_office.required'           => 'Post Office is required',
                'facebook_id.required'           => 'Facebook ID is required',
                'image.required'                 => 'Image is required',
                'signature.required'             => 'Signature is required',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            $bankUser = BankUser::find($request->bankUser_id);

            if ($request->image) {                                                // find img
                # code...
                // Delete Old Image
                if (File::exists('images/user/' . $bankUser->image)) {
                    # code...
                    File::delete('images/user/' . $bankUser->image);
                }

                $image = $request->file('image');                                 // received img
                $img = time() . '-br.' . $image->getClientOriginalExtension();    // make img name
                $location = public_path('images/user/' . $img);                  // find img location
                Image::make($image)->save($location);                             // save img location
                $bankUser->image = $img;                                             // save img
            } else {
                # code...
                $bankUser->image = $request->bankUser_img;
            }
            if( !is_null( $bankUser ) ) {
                
                $latestMemberId = BankUser::where('member_id', '<>', null)->orderBy('updated_at', 'desc')->first();

                $prefix = $request->comitee_designation == 'Lifetime Member' ? 'LM-' : 'M-';

                $latestMemberId = BankUser::where('member_id', 'LIKE', $prefix . '%')
                    ->whereNotNull('member_id')
                    ->get()
                    ->map(function ($user) use ($prefix) {
                        // Extract the numeric part of the member_id
                        $chunks = mb_split("-", $user->member_id);
                        return [
                            'user' => $user,
                            'numeric_part' => (int) $chunks[1], // Convert to integer for comparison
                        ];
                    })
                    ->sortByDesc('numeric_part') // Sort by the numeric part descending
                    ->first(); // Get the one with the largest number
                
                if ($latestMemberId) {
                    $mem_id_without_prefix = $latestMemberId['numeric_part'];
                
                    $newMemberId = $request->comitee_designation == 'Lifetime Member' ? 'LM-' : 'M-';
                
                    // Increment the numeric part for the new member ID
                    $value = $mem_id_without_prefix + 1;
                
                    $new_mem_id = $newMemberId . $value;
                    $bankUser->member_id = $new_mem_id;
                }
                 else {
                    $newMemberId = $request->comitee_designation == 'Lifetime Member' ? 'LM-1' : 'M-1';
                    // Log::info("message ".$newMemberId);
                    $bankUser->member_id = $newMemberId;
                }

                // $bankUser->member_id              = $request->member_id;
                $bankUser->name                   = $request->name;
                $bankUser->email                  = $request->email;
                $bankUser->contact                = $request->contact;
                $bankUser->mobile                = $request->mobile;
                $bankUser->father_name            = $request->father_name;
                $bankUser->mother_name            = $request->mother_name;
                $bankUser->spouse_name            = $request->spouse_name;
                $bankUser->birth_date             = $request->birth_date;
                $bankUser->nationality            = $request->nationality;
                $bankUser->nid                    = $request->national_id;
                $bankUser->religion               = $request->religion;
                $bankUser->designation_id         = $request->designation_id;
                $bankUser->comitee_designation    = $request->comitee_designation;
                $bankUser->blood_group            = $request->blood_group;
                $bankUser->district               = $request->district;
                $bankUser->thana_id               = $request->thana_id;
                $bankUser->union_id               = $request->union_id;
                $bankUser->village_id             = $request->village_id;
                $bankUser->post_office            = $request->post_office;
                $bankUser->bank_name              = $request->bank_name;
                $bankUser->branch                 = $request->branch;
                $bankUser->section                = $request->section;
                $bankUser->facebook_id            = $request->facebook_id;
                $bankUser->present_address        = $request->present_address;
                $bankUser->status                 = $request->status;

                $bankUser->save();

                if ( $request->status == 1 ) {
                    $user = new User;
                    $user->name        = $request->name;
                    $user->email       = $request->email;
                    $user->password    = Hash::make( mt_rand(10000000, 99999999) );
                    $user->save();
                    // Log::info($user);
                }

                return response()->json([
                    'status' => 200,
                    'message' => "User Updated Successfully"
                ]);
            }
        }

        // return $this->bankUserService->getUpdatedBankUser($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {

		$bankUser = BankUser::find($request->id);
        // log::info($request);
        // $bankUser->delete();
        if (File::exists('images/user/' . $bankUser->image)) {
            # code...
            File::delete('images/user/' . $bankUser->image);
        }

		BankUser::destroy($request->id);
        return response()->json([
            'status' => 200,
            'messages' => 'Deleted Successfully'
        ]);
	}

    public function reportMember() {
        return view('backend.bankUser.report_member');
    }

    public function showReportMember(Request $request)
    {
        if( $request->member_type == 'Lifetime Member' || $request->member_type == 'General Member' ) {
            # code...
            // $member_reports = BankUser::where('comitee_designation', 'LIKE', '%' . $request->member_type . '%')->get();
            $member_reports = DB::table('bank_users')
                ->join('villages', 'bank_users.village_id', '=', 'villages.id')
                ->select('bank_users.*', 'villages.name as village')
                ->where('bank_users.status', 1)
                ->where('comitee_designation', 'LIKE', '%' . $request->member_type . '%')
                ->get();
            // Log::info($yearly_reports);
            return response()->json($member_reports);
        }
        elseif( $request->member_type == 'All' ) {
            # code...
            // $member_reports = BankUser::where('status', 1)->get();
            $member_reports = DB::table('bank_users')
                ->join('villages', 'bank_users.village_id', '=', 'villages.id')
                ->select('bank_users.*', 'villages.name as village')
                ->where('bank_users.status', 1)
                ->get();
            // Log::info($member_reports);
            return response()->json($member_reports);
        }
        else {
            // 404 Page not Found
        }
    }
    
    public function userInfo() {

        return view('backend.userInfo.update_user_info');
    }

    public function updateUserInfo(Request $request) {

        $bankUser = Auth::user()->bankUser->find($request->user_id);
        
        if ($request->image) {                                                // find img
            # code...
            // Delete Old Image
            if (File::exists('images/user/' . $bankUser->image)) {
                # code...
                File::delete('images/user/' . $bankUser->image);
            }

            $image = $request->file('image');                                 // received img
            $img = time() . '-br.' . $image->getClientOriginalExtension();    // make img name
            $location = public_path('images/user/' . $img);                  // find img location

            $imgFile = Image::make($image);
            $imgFile->resize(206, 206, function ($constraint) {
                $constraint->aspectRatio();
            })->save($location);

            // Image::make($image)->save($location);                             // save img location
            $bankUser->image = $img;                                             // save img
        }
        if ($request->signature) {                                                // find img
            # code...
            // Delete Old Image
            if (File::exists('images/signature/' . $bankUser->signature)) {
                # code...
                File::delete('images/signature/' . $bankUser->signature);
            }

            $signature = $request->file('signature');                                 // received img
            $sign = time() . '-br.' . $signature->getClientOriginalExtension();    // make img name
            $location = public_path('images/signature/' . $sign);                  // find img location

            $signFile = Image::make($signature);
            $signFile->resize(206, 206, function ($constraint) {
                $constraint->aspectRatio();
            })->save($location);

            // Image::make($image)->save($location);                             // save img location
            $bankUser->signature = $sign;                                             // save img
        }

        if( !is_null( $bankUser ) ) {

            $bankUser->designation_id         = $request->designation_id;
            $bankUser->bank_name              = $request->bank_name;
            $bankUser->branch                 = $request->branch;
            $bankUser->district               = $request->district;
            $bankUser->contact                = $request->contact;

            $bankUser->save();

            $notification = array (
                'message' => 'User Information Updated!',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        } 
        
    }
}
