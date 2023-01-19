<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Hash;
use Session;

class AuthController extends Controller
{
    public function login(){

        if(Auth::check()){
            return redirect('home');
        }
  
        return view('auth.login');
    }

    public function loginUser(Request $req){

        $req->validate([
            'email'=>['required'],
            'password'=>['required'],
        ]);

        $credentials = $req->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $req->session()->put('loggedInUser',$req->email);
            return redirect()->intended('home')
                        ->withSuccess('Signed in');
        }
  
        return back()->with('error','Login details are not valid!');

    }

    public function register(){

        return view('auth.register');
    }

    public function registerUser(Request $req){

        $req->validate([
            'name' => 'required|min:2|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:100',
            'rpassword' =>'required|same:password',
            'role'=>'required',
        ]);

        $data=$req->all();

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' =>$data['role']
        ]);

        return redirect("auth/login")->with('success','Registration Successful!');
        
    }

    public function logoutUser(){
        Session::flush();
        Auth::logout();
  
        return Redirect('auth/login')->withSuccess('Successfully Signed Out!');
    }

    public function recover(){

        return view('auth.recover');

    }
}
