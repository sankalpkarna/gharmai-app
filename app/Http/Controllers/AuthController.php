<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Support\Facades\Auth;
use Hash;
use Session;
use Mail;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use DB; 
use Carbon\Carbon; 

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
        $roles = Role::latest()->get();
        return view('auth.register',compact('roles'));
    }

    public function registerUser(Request $req){
        $req->validate([
            'name' => 'required|min:2|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:100',
            'confirm_password' =>'required|same:password',
            'role'=>'required',
        ]);
        $data=$req->all();
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ])->assignRole($data['role']);

        $token = Str::random(64);

        UserVerify::create([
              'id' => $user->id, 
              'token' => $token
        ]);

        Mail::send('auth.verifyemail', ['token' => $token], function($message) use($req){
              $message->to($req->email);
              $message->subject('Email Verification Mail');
        }); 
        return redirect('auth/login')->with('info', 'We have e-mailed your Email Verification link!');
    }

    public function verify($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();
        $message = 'Sorry your email cannot be identified.';
        if(!is_null($verifyUser) ){
            $user = $verifyUser->user;
            if(!$user->is_email_verified) {
                $user->is_email_verified = 1;
                $user->save();
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }  
      return redirect()->route('login')->with('info', $message);
    }

    public function logoutUser(){
        Session::flush();
        Auth::logout();  
        return redirect('auth/login')->withSuccess('Successfully Signed Out!');
    }

    public function recover(){
        return view('auth.recover');
    }

    public function recoverUser(Request $req){

        $req->validate([
            'email'=>'required|email|exists:users',
        ]);
        $token = Str::random(64);
        $email = $req->email;
        DB::table('password_resets')->insert([
              'email' => $email, 
              'token' => $token, 
              'created_at' => Carbon::now()
            ]);  
        Mail::send('auth.recoveremail', ['token' => $token, 'email' =>$req->email], function($message) use($req){
              $message->to($req->email);
              $message->subject('Reset Password');
          });  
        return redirect('auth/login')->with('info', 'We have e-mailed your password reset link!');
    }

    public function reset($token, $email){
        return view('auth.reset', ['token' => $token, 'email'=> $email]);
    }


    public function resetUser(Request $req){
        $req->validate([
            'password' => 'required|min:6|max:100',
            'confirm_password' =>'required|same:password',
        ]);

        $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => $req->email, 
                                'token' => $req->token
                              ])
                              ->first();
          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid token!');
          }  
          $user = User::where('email', $req->email)
                      ->update(['password' => Hash::make($req->password)]); 
          DB::table('password_resets')->where(['email'=> $req->email])->delete();  
          return redirect('auth/login')->with('info', 'Your password has been changed!');
    }
}
