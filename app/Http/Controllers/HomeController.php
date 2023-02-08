<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function __construct(){

        $this->middleware('auth');
        $this->middleware('verify_email');

    }
    
    public function index(){

        if(Auth::check()){

            $user = Auth::user();

            if ($user->hasRole('superadmin')) {

                return view('home');

            } 
            elseif ($user->hasRole('admin')) {

                return view('home');

            } 
            elseif ($user->hasRole('provider')) {

                return view('home');

            } 
            elseif ($user->hasRole('customer')) {

                return view('home');

            } 
            else {

                return 'NO ROLE ASSIGNED YET!';
            }
        }

        return redirect("auth/login")->withSuccess('You are not allowed to access');
    }

}
