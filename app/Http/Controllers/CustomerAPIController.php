<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerAPIController extends Controller
{
    //
    
    function getData(){
        return ["name"=>"sankalp","email"=>"karn.sankalp@gmail.com"];
    }
}
