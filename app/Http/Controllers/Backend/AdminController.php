<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
// use App\Models\Store;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    public function regUser()
    {

        $roles  = Role::all();

        //  dd($roles);
        return view('backend/user-management/user/create-user', ['roles' => $roles]);
    }

    public function storeUser(Request $request)
    {


        $messages = [
            'name.required'  =>    "Name is required.",
            'name.max'  =>    "Max 255 characters.",
            'email.required'  =>    "Email is required.",
            'email.email'  =>    "Email is not valid.",
            'email.max'  =>    "Max 255 characters.",
            'email.unique'  =>    "Email already exists.",
            // 'contactnumber.required'  =>    "Contact number is required.",
            'roles.required'  =>    "Role is required.",
            'password.required'  =>    "Password is required.",
            'password.confirmed'  =>    "Confirm your password or password does not match.",
        ];



        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            // 'contactnumber' => ['required'],
            'roles' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], $messages);

        if ($validator->passes()) {
            $user = new User();

            $user->name                           = $request->name;
            $user->email                          = $request->email;
            $user->password                       =  Hash::make($request->password);
            // $user->contact_number                 = $request->contactnumber;
            // $user->store_id                     = $request->store;

            // $user->subscriber_id                  = Auth::user()->subscriber_id;

            if ($request->roles) {
                $user->assignRole($request->roles);
            }
            $user->save();
            // Auth::login($user);
            event(new Registered($user));
            return redirect()->route('admin.roles');
        }
        return response()->json(['error' => $validator->errors()]);
    }
    public function userList()
    {
        $roles  = Role::all();
        //$users = User::all();
        $users = User::all();
        // $stores = Store::join('users, stores.id', 'users.store_id')
        //                 ->where('users.subscriber_id', Auth::user()->subscriber_id)
        //                 ->get();

        return view('backend/user-management/user/user-index', compact('users', 'roles'));
    }



    public function userEdit(Request $request, $id)
    {


        $user = User::find($id);
        $roles  = Role::all();
        //$users = User::all();
        //$users = User::where('subscriber_id', Auth::user()->subscriber_id)->get();
        if ($request->ajax()) {
            return response()->json([
                'status' => 200,
                'user' => $user,

            ]);
        }
        return view('backend/user-management/user/user-edit', compact('user', 'roles'));
    }


    public function userUpdate(Request $request, $id)
    {
        // Create New User
        $user = User::find($id);
        $messages = [
            'name.required'  =>    "Name is required.",
            'name.max'  =>    "Max 255 characters.",
            'email.required'  =>    "Email is required.",
            'email.email'  =>    "Email is not valid.",
            'email.max'  =>    "Max 255 characters.",
            // 'contactnumber.required'  =>    "Contact number is required.",
            'roles.required'  =>    "Role is required.",
            // 'password.required'  =>    "Password is required.",
            'password.confirmed'  =>    "Confirm your password or password does not match.",
        ];



        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            // 'contactnumber' => ['required'],
            'roles' => ['required'],
            // 'password' => ['required', 'confirmed'],
            'password' => ['confirmed'],
        ], $messages);

        if ($validator->passes()) {

            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            $user->roles()->detach();
            if ($request->roles) {
                $user->assignRole($request->roles);
            }


            return response()->json([
                'status' => 200,
                'message' => 'Product updated successfully!'
            ]);
            return redirect()->route('admin.roles');
        }

        return response()->json(['error' => $validator->errors()]);
    }


    public function userDestroy($id)
    {
        $user = User::find($id);
        if (!is_null($user)) {
            $user->delete();
        }

        session()->flash('success', 'User has been deleted !!');
        return back();
    }

}
