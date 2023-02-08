<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Hash;

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

        $data= User::findOrFail(Auth::user()->id);
        return view('profile.index',compact('data'));
    }

    public function update(Request $req){

        $req->validate([
            'name' => 'required|min:2|max:100',
            'role'=>'required',
        ]);

        $user=auth()->user();

        $user->update([
            'name'=> $req->name,
            'role'=> $req->role,
        ]);
   
        return redirect()->route('profile')->with('success','Profile Updated');

    }

    public function destroy(){

        


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
