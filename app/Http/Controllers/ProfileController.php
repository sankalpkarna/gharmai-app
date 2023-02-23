<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Hash;
use Spatie\Permission\Models\Role;

class ProfileController extends Controller
{
    //

    public function __construct(){
        $this->middleware('permission:profile-index|profile-create|profile-edit|profile-delete', ['only' => ['index']]);
        $this->middleware('permission:profile-create', ['only' => ['create','store']]);
        $this->middleware('permission:profile-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:profile-destroy', ['only' => ['destroy']]);   
    }
    
    public function index(){

        $user= User::findOrFail(Auth::user()->id);
        $roles = Role::latest()->get();

        return view('profile.index',compact('user','roles'));
    }

    public function update(Request $req){
        $req->validate([
            'name' => 'required|min:2|max:100',
            'mobile_number' =>'required',
            'gender' => 'required',
            'dob' => 'required|date',
            'address' => 'required|max:255',
        ]);
        $user=auth()->user();
        $user->update([
            'name' => $req->name,
            'mobile_number' =>$req->mobile_number,
            'gender' => $req->gender,
            'dob' => $req->dob,
            'address' => $req->address
        ]);
        return redirect()->route('profile')->with('success','Profile Updated');
    }

    public function changeProfilepic(Request $req){
        if($req->file('profile_image')){
            $req->validate([
            'profile_image' => 'image|mimes:png,jpg,jpeg|max:2048',
            ]);

            if($req->file('profile_image')){

                $req->file('profile_image')->storeAs('public/users',$req->id);    
            }
            return redirect()->route('profile')->with('success','Profile Picture Updated');
        }
        else{
            return redirect()->route('profile')->with('info','Please upload Profile Picture');
        }
    }

    public function destroy(){

        $user = User::With('roles')->findOrFail(Auth::user()->id);
        // return $user->roles;
        $role=$user->roles->first();
        $user->removeRole($role);
        $user->delete();
        return redirect()->route('login')->with('success','Profile Deletion Successful!');
    }

    public function security(){
        return view('profile.security');
    }

    public function changePassword(Request $req){

        $req->validate([
            'current_password' => 'required',
            'new_password' => 'required',
            'confirm_new_password' => 'required|same:new_password'
        ]);

        #Match The Old Password
        if(!Hash::check($req->current_password, auth()->user()->password)){
            return back()->with("error", "Current Password Doesn't match!");
        }

        if(strcmp($req->get('current_password'), $req->get('new_password')) == 0){
            return back()->with([
                'info' => 'New Password cannot be same as your Current password! Please choose a different password.'
            ]);
        }

        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($req->new_password)
        ]);

        Auth::logout();
        return redirect('/auth/login')->with("info", "Password changed successfully! You can now login.");
    }
}
