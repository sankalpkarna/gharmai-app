<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Hash;

class HomeController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(){
    
        if(Auth::check()){

            return view('home');
        }
  
       return redirect("auth/login")->withSuccess('You are not allowed to access');
    }

    public function profile(){

        $data= User::findOrFail(Auth::user()->id);
        return view('profile.index',compact('data'));
    }

    public function profileUpdate(Request $req){

        $req->validate([
            'name' => 'required|min:2|max:100',
            'role'=>'required',
        ]);

        $user=auth()->user();

        $user->update([
            'name'              => $req->name,
            'role'             => $req->role,
        ]);
   
        return redirect()->route('profile')->with('success','Profile Updated');

    }

    public function destroyProfile(){


    }

    public function changePassword(){

    }
}
