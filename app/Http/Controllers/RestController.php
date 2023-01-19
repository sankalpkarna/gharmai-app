<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RestController extends Controller
{
 
    function index(){
        $data=HTTP::Get("https://reqres.in/api/users?page=2");
       // print_r($data['data']);
        return view('rest/index',['data'=>$data['data']]);
    }
    //
}
