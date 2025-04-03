<?php

namespace App\Http\Controllers\frontend;

use Log;
// use PDF;
// use Barryvdh\DomPDF\Facade\Pdf;
use Auth;
use File;
use Mail;
use Image;
use App\Models\User;
use App\Models\Thana;
use App\Models\Union;
use App\Models\Slider;
use App\Models\Speech;
use App\Models\Advisor;
use App\Models\BankUser;
use App\Models\Category;
use App\Models\District;
use App\Mail\ContactMail;
use App\Mail\VerifiedOTP;
use App\Models\JobSeeker;
use App\Models\PhotoLink;
use App\Models\NewsTicker;
use App\Models\Designation;
use App\Models\MournMember;
use App\Models\NoticeBoard;
use App\Models\PhotoGallary;
use Illuminate\Http\Request;
use App\Models\ProgrammeDate;
use App\Models\CentralComitee;
use App\Models\DoharSubComitee;
use Illuminate\Support\Facades\DB;
use App\Models\NawabganjSubComitee;
use App\Http\Controllers\Controller;
use App\Models\AccessoriesPromoSlider;
use Illuminate\Support\Facades\Validator;

class HomeViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::where('status', 1)->get();
        $categories = Category::get();
        $notice_boards = NoticeBoard::where('role', 'Notice Board')->latest()->take(3)->get();
        $advisors = Speech::where('role', 'Advisor')->latest()->take(1)->get();
        $presidents = Speech::where('role', 'President')->latest()->take(1)->get();
        $secretaries = Speech::where('role', 'Secretary')->latest()->take(1)->get();
        $visions = NoticeBoard::where('role', 'Mission and Vision')->latest()->take(1)->get();
        // $accessories_promo_sliders = AccessoriesPromoSlider::where('status', 1)->latest()->take(1)->get();
        return view('frontview.pages.homepage', compact('sliders', 'categories', 'notice_boards', 'advisors', 'presidents', 'secretaries', 'visions'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {
        return view('frontview.pages.contact');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function jobSeekerForm()
    {
        $districts = District::orderBy('name', 'asc')->where('status', 1)->get();
        $thanas = Thana::orderBy('name', 'asc')->where('status', 1)->get();
        $unions = Union::orderBy('name', 'asc')->where('status', 1)->get();
        return view('frontview.pages.jobSeeker_form', compact('districts', 'thanas', 'unions'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function registerForm()
    {
        $designations = Designation::orderBy('designation', 'asc')->get();
        $districts = District::orderBy('name', 'asc')->where('status', 1)->get();
        $thanas = Thana::orderBy('name', 'asc')->where('status', 1)->get();
        $unions = Union::orderBy('name', 'asc')->where('status', 1)->get();
        return view('frontview.pages.registration_form', compact('designations', 'districts', 'thanas', 'unions'));
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function submitRegisterForm(Request $request)
    {
        // Log::info($request);

        $validator = Validator::make($request->all(), [
            'name'                => 'required',
            'email'               => 'required|unique:bank_users|email',
            'contact'             => 'required|numeric|min:10',
            'mobile'             => 'required|numeric|min:10',
            'father_name'         => 'required|max:255',
            'mother_name'         => 'required|max:255',
            'spouse_name'         => 'required|max:255',
            'birth_date'          => 'required|max:20',
            'nationality'         => 'required|max:20',
            'national_id'         => 'required|numeric|min:10',
            'religion'            => 'required|max:20',
            'bank_name'           => 'required|max:200',
            'designation_id'      => 'required|max:250',
            'comitee_designation' => 'required|max:200',
            'transaction_id'      => 'required|max:20',
            'blood_group'         => 'required|max:30',
            'district'            => 'required|max:200',
            'thana_id'            => 'required|max:20',
            'union_id'            => 'required|max:20',
            'village_id'          => 'required|max:20',
            'post_office'         => 'required|max:200',
            'branch'              => 'required|max:200',
            'section'             => 'required|max:200',
            'facebook_id'         => 'required|max:200',
            // 'present_address'     => 'required|max:20',
            'image'               => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            'signature'           => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            ],
            [
                'name.required'                  => 'Name is required',
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
                'mobile.required'               => 'Mobile is required',
                'contact.min'                    => ' Contact Number must be at least 11 digits.',
                'designation_id.required'        => 'Designation is required',
                'comitee_designation.required'   => 'Member Type is required',
                'transaction_id.required'        => 'Transaction ID is required',
                'blood_group.required'           => 'Blood Group is required',
                // 'present_address.required'       => 'Present Address is required',
                'district.required'              => 'District is required',
                'thana_id.required'              => 'Upzila is required',
                'union_id.required'              => 'Union is required',
                'village_id.required'            => 'Village is required',
                'branch.required'                => 'Branch is required',
                'section.required'               => 'District is required',
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
            # code...

            $bankUser = new BankUser;

            // if ($request->comitee_designation == 'Lifetime Member') {
            //     # code...
            //     $bankUser->member_id              = 'LM-' . mt_rand(0000, 9999);
            // }
            // else {
            //     # code...
            //     $bankUser->member_id              = 'GM-' . mt_rand(0000, 9999);
            // }
            $bankUser->name                   = $request->name;
            $bankUser->email                  = $request->email;
            $bankUser->contact                = $request->contact;
            $bankUser->mobile                = $request->mobile;
            $bankUser->father_name            = $request->father_name;
            $bankUser->mother_name            = $request->mother_name;
            $bankUser->spouse_name            = $request->spouse_name;
            $birthDate = $request->birth_date;

            // Convert to 'YYYY-MM-DD' format
            $dateParts = explode('/', $birthDate);
            if (count($dateParts) === 3) {
                $day = $dateParts[0];
                $month = $dateParts[1];
                $year = $dateParts[2];
                
                // Create a new date string in 'YYYY-MM-DD' format
                $formattedDate = "{$year}-{$month}-{$day}";
                
                // Assign to the bankUser object
                $bankUser->birth_date = $formattedDate;
            } 
            $bankUser->nationality            = $request->nationality;
            $bankUser->nid                    = $request->national_id;
            $bankUser->religion               = $request->religion;
            $bankUser->designation_id         = $request->designation_id;
            $bankUser->comitee_designation    = $request->comitee_designation;
            $bankUser->transaction_id         = $request->transaction_id;
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


            if ($request->image) {                                                // find img
                # code...
                $image = $request->file('image');                                 // received img
                $img = time() . '-br.' . $image->getClientOriginalExtension();    // make img name
                $location = public_path('images/user/' . $img);                  // find img location

                $imgFile = Image::make($image);
                $imgFile->resize(206, 206, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($location);

                // Image::make($image)->save($location);                             // save img location
                $bankUser->image  = $img;
            }

            if ($request->signature) {                                                // find img
                # code...
                $signature = $request->file('signature');                                 // received img
                $sign = time() . '-br.' . $signature->getClientOriginalExtension();    // make img name
                $location = public_path('images/signature/' . $sign);                  // find img location

                $imgFile = Image::make($signature);
                $imgFile->resize(105, 105, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($location);

                // Image::make($signature)->save($location);                             // save img location
                $bankUser->signature  = $sign;
            }

            // Log::info($bankUser);
            $bankUser->save();
            return response()->json([
                'status' => 200,
                'message' => "Registration Successfully"
            ]);
        }

        // return $this->bankUserService->getAddBankUser($request);
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function submitJobSeekerForm(Request $request)
    {
        $request->validate(
            [
                'name'              => 'required',
                'email'             => 'required|unique:job_seekers|email',
                'phone'             => 'required|min:11',
                'father_name'       => 'required|max:200',
                'mother_name'       => 'required|max:200',
                'district'          => 'required',
                'thana'             => 'required',
                'union'             => 'required',
                'village'           => 'required|max:200',
                // 'permanent_address' => 'required|max:20',
                // 'present_address'   => 'required|max:20',
                'education_details' => 'required|max:255',
            ],
            [
                'name.required'              => 'Name is required',
                'email.required'             => 'Email is required',
                'email.unique'               => 'Email Already Exists',
                'phone.required'             => 'Phone Number is required',
                'father_name.required'       => 'Father Name is required',
                'mother_name.required'       => 'Mother Name is required',
                'district.required'          => 'District Name is required',
                'thana.required'             => 'Thana Name is required',
                'union.required'             => 'Union Name is required',
                'village.required'           => 'Village Name is required',
                // 'present_address.required'   => 'Present address is required',
                // 'permanent_address.required' => 'Permanent address is required',
                'education_details.required' => 'Education details is required',
            ]
        );

        $jobSeekerData = [
            'job_id'             => mt_rand(1000, 9999),
            'name'               => $request->name,
            'email'              => $request->email,
            'contact'            => $request->phone,
            'father_name'        => $request->father_name,
            'mother_name'        => $request->mother_name,
            'district'           => $request->district,
            'thana_id'           => $request->thana,
            'union_id'           => $request->union,
            'village'            => $request->village,
            'present_address'    => $request->present_address,
            // 'permanent_address'  => $request->permanent_address,
            'education_details'  => $request->education_details,
        ];

        // Log::info($jobSeekerData);

        JobSeeker::create($jobSeekerData);
        return response()->json([
            'status' => 200,
            'data' => $jobSeekerData,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function noticePage(String $id)
    {
        $sliders = Slider::where('status', 1)->get();
        $notice = NoticeBoard::find($id);
        // Log::info($speecher);
        return view('frontview.pages.noticePage', compact('notice', 'sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function speechPage(String $id)
    {
        $sliders = Slider::where('status', 1)->get();
        $speecher = Speech::find($id);
        // Log::info($speecher);
        return view('frontview.pages.speechPage', compact('speecher', 'sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function eventPage(String $id)
    {
        $sliders = Slider::where('status', 1)->get();
        $category = Category::find($id);
        // Log::info($category);
        return view('frontview.pages.eventPage', compact('category', 'sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function centralCommunity()
    {
        $centralComitees = CentralComitee::orderBy('priority', 'asc')->where('current', 1)->get();
        return view('frontview.pages.central_community_page', compact('centralComitees'));
    }

    public function nawabganjSubComitee()
    {
        $nawabganjSubComitees = NawabganjSubComitee::orderBy('priority', 'asc')->where('current', 1)->get();
        return view('frontview.pages.nawabganj_subcomitee_page', compact('nawabganjSubComitees'));
    }

    public function doharSubComitee()
    {
        $doharSubComitees = DoharSubComitee::orderBy('priority', 'asc')->where('current', 1)->get();
        return view('frontview.pages.dohar_subcomitee_page', compact('doharSubComitees'));
    }
    
    public function advisorComitee()
    {
        $doharSubComitees = Advisor::orderBy('priority', 'asc')->where('current', 1)->get();
        return view('frontview.pages.advisor_community_page', compact('doharSubComitees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lifetimeMember()
    {
        $lifetimeMembers = BankUser::orderBy('id', 'asc')->where('comitee_designation', 'Lifetime Member')->where('status', 1)->get();
        return view('frontview.pages.lifetime_member_page', compact('lifetimeMembers'));
    }

    public function generalMember()
    {
        $generalMembers = BankUser::orderBy('id', 'asc')->where('comitee_designation', 'General Member')->where('status', 1)->get();
        return view('frontview.pages.general_member_page', compact('generalMembers'));
    }

    public function mournMember()
    {
        $mournMembers = DB::table('mourn_members')
            ->join('bank_users', 'mourn_members.member_id', '=', 'bank_users.member_id')
            ->select('bank_users.*', 'mourn_members.died_date')
            ->get();
        // Log::info($mournMembers);
        return view('frontview.pages.mourn_member_page', compact('mournMembers'));
    }

    public function search()
    {
        return view('frontview.pages.search_page');
    }

    public function photoGallary()
    {
        $photoGallaries = PhotoGallary::latest()->paginate(6);
        $photoLinks = PhotoLink::all();
        return view('frontview.pages.photo_gallary', compact('photoGallaries', 'photoLinks'));
    }

    // public function pagination()
    // {
    //     $photoGallaries = PhotoGallary::latest()->paginate(9);
    //     return view('frontview.pages.pagination', compact('photoGallaries'))->render();
    // }

    public function downloadForm(Request $request)
    {
        $search = $request['member_id'] ?? "";
        if ( $search != "" ) {
            # code...
            $download_pdf = BankUser::where('member_id', $search)->orWhere('contact', $search)->first();
            // Log::info($download_pdf);

            if ($download_pdf != "") {
                # code...
                return view('frontview.pages.pdf_membership_form', compact('download_pdf'));
            }else {
                # code...
                $notification = array (
                    'message' => 'Not Match Your Membership ID or Phone. Forget Your Membership ID, Please Contact With Us.',
                    'alert-type' => 'error',
                );
                return redirect()->back()->with($notification);
            }

        }
        else {
            $notification = array (
                'message' => 'Please Enter Your Membership ID or Phone no.',
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        }
    }

    public function getDownload()
    {
        //PDF file is stored under project/public/download/info.pdf
        $file= public_path(). "/download-form/Membership-Form.pdf";

        $headers = array(
                'Content-Type: application/pdf',
                );

        return response()->download($file, 'download-form.pdf', $headers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function findMember(Request $request)
    {
        if ( $request->thana && $request->union ) {
            # code...
            $search_members = BankUser::where('thana_id', 'LIKE', '%' . $request->thana . '%')
            ->where('union_id', 'LIKE', '%' . $request->union . '%')
            ->get();
            return response()->json(
                ['members'=>$search_members]);
        }
        else {
            // 404 Page not Found
        }
    }

    public function findComitee(Request $request)
    {
        if ( $request->duration ) {
            # code...
            $search_comitees = DB::table('central_comitees')
            ->join('bank_users', 'central_comitees.member_id', '=', 'bank_users.id')
            ->select('bank_users.*', 'central_comitees.comitee', 'central_comitees.comitee_designation', 'central_comitees.form', 'central_comitees.to_year')
            ->where('duration', $request->duration)
            ->get();
            // Log::info($search_comitees);
            return response()->json(
                ['members'=>$search_comitees]);
        }
        else {
            // 404 Page not Found
        }
    }

    public function findNawabganjSubComitee(Request $request)
    {
        if ( $request->duration ) {
            # code...
            $search_comitees = DB::table('nawabganj_sub_comitees')
            ->join('bank_users', 'nawabganj_sub_comitees.member_id', '=', 'bank_users.id')
            ->select('bank_users.*', 'nawabganj_sub_comitees.comitee', 'nawabganj_sub_comitees.comitee_designation', 'nawabganj_sub_comitees.form', 'nawabganj_sub_comitees.to_year')
            ->where('duration', $request->duration)
            ->get();
            // Log::info($search_comitees);
            return response()->json(
                ['members'=>$search_comitees]);
        }
        else {
            // 404 Page not Found
        }
    }

    public function findDoharSubComitee(Request $request)
    {
        if ( $request->duration ) {
            # code...
            $search_comitees = DB::table('dohar_sub_comitees')
            ->join('bank_users', 'dohar_sub_comitees.member_id', '=', 'bank_users.id')
            ->select('bank_users.*', 'dohar_sub_comitees.comitee', 'dohar_sub_comitees.comitee_designation', 'dohar_sub_comitees.form', 'dohar_sub_comitees.to_year')
            ->where('duration', $request->duration)
            ->get();
            // Log::info($search_comitees);
            return response()->json(
                ['members'=>$search_comitees]);
        }
        else {
            // 404 Page not Found
        }
    }

    public function searchStatus(Request $request)
    {

        $search = $request['job_id'] ?? "";
        if ( $search != "" ) {
            # code...
            $search_job_status = JobSeeker::where('job_id', $search)->orWhere('contact', $search)->first();
            if ($search_job_status != "") {
                # code...
                return view('frontview.pages.status_and_feedback_page', compact('search_job_status'));
            }else {
                # code...
                $notification = array (
                    'message' => 'Not Found Your Job Status. Forget Your JOB ID, Please Contact With Us.',
                    'alert-type' => 'error',
                );
                return redirect()->back()->with($notification);
            }
        }
        else {
            $notification = array (
                'message' => 'Please Enter Your JOB ID or Phone no.',
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        }
    }

    public function feedbackStatus(Request $request)
    {
        $jobSeeker_id = $request['jobSeeker_id'];
        $jobSeeker = JobSeeker::find($jobSeeker_id);
        // Log::info($jobSeeker);
        if( !is_null( $jobSeeker ) ) {
            $jobSeeker->job_id          = $request->job_id;
            $jobSeeker->status          = $request->status;
            $jobSeeker->comment         = $request->comment;
            $jobSeeker->feedback        = $request->feedback;

            $jobSeeker->save();
            return response()->json(
                ['status' => 200]
            );
        }
        else {
            // 404 Page not Found
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userLogin()
    {
        return view('frontview.login.otp_page');
    }

    public function sendOTP(Request $request)
    {
        // Log::info($request);
        if ($request->email != "") {
            # code...
            $std = User::where('email',$request->email)->first();
            if ($std != "") {
                # code...
                $std->otp = mt_rand(10000,99999);
                $std->save();
                $mailData = [
                    'name'    => $std->name,
                    'email'   => $std->email,
                    'otp'     => $std->otp,
                ];
                $userMail = $std->email;
                Mail::to($userMail)->send( new VerifiedOTP($mailData) );
                // Log::info($mailData);
                return view('frontview.login.submit_otp_page', compact('std'));
            } else {
                # code...
                $notification = array (
                    'message' => 'Email Not Exist.',
                    'alert-type' => 'success',
                );
                return redirect()->back()->with($notification);
            }
        } else {
            # code...
            $notification = array (
                'message' => 'Email is required.',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        }


        // $messages = [
        //     'email.required' => 'Email is required',
        // ];
        // $validator = Validator::make($request->all(), [
        //     'email'         => 'required',
        // ], $messages);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'status' => 400,
        //         'errors' => $validator->messages()
        //     ]);
        // } else {
        //     # code...
        //     $otp = mt_rand(10000,99999);
        //     $std = User::where('email',$request->email)->update(['otp' => $otp]);

        //     if ($std == true) {
        //         return response()->json([
        //             "status" => 200,
        //             "message" => "OTP send Successfully",
        //             "data" => $std
        //         ]);
        //     } else {
        //         return response()->json([
        //             "status" => 401,
        //             "message" => "Email Not Exist"
        //         ]);
        //     }
        // }

        // if ($std == true) {
        //     return response()->json([
        //         "status" => 200,
        //         "message" => "OTP send Successfully",
        //         "data" => $std
        //     ]);
        // } else {
        //     return response()->json([
        //         "status" => 400,
        //         "message" => "Email Not Exist"
        //     ]);
        // }
    }

    public function loginWithOtp(Request $request){
        // Log::info($request);
        $user  = User::where([['email','=',request('email')],['otp','=',request('otp')]])->first();
        // Log::info($user);
        if( $user) {
            Auth::login($user, true);
            User::where('email','=',$request->email)->update(['otp' => null]);
            // return view('dashboard');
            return response()->json([
                'status' => 200
            ]);
        }
        else{
            return response()->json([
                'status' => 400,
            ]);
            // return redirect()->back()->with($notification);
        }
    }

    public function contactMail(Request $request)
    {
        // Log::info($request);
        $messages = [
            'name.required'    => 'Name is required',
            'email.required'   => 'Email is required',
            'subject.required' => 'Subject is required',
            'message.required' => 'Message is required',
        ];
        $validator = Validator::make($request->all(), [
            'name'         => 'required',
            'email'        => 'required|email',
            'subject'      => 'required',
            'message'      => 'required',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            # code...
            $mailData = [
                'name'    => $request->name,
                'email'   => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
            ];

            Mail::to('info.dnba@gmail.com')->send( new ContactMail($mailData) );
            return response()->json([
                'status' => 200
            ]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function programRegisterForm()
    {
        $programmeDate = ProgrammeDate::where('status', 1)->latest()->take(1)->get();
        return view('frontview.pages.programme_registration_form', compact('programmeDate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
