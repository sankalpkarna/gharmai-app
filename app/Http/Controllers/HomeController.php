<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

}
