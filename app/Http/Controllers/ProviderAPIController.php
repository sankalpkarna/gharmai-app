<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provider;
use Validator;

class ProviderAPIController extends Controller
{
    //
    function index($id=null){

        return $id?Provider::find($id):Provider::all();
    }

    function store(Request $req){

        $rules= array(
            "cat_id" =>"required",
            "username" => "required",
            "password" => "required",
            "name" => "required",
            "dob" => "required",
            "email" => "required",
            "mobno" => "required | max:10",
            
        );

        $validator= Validator::make($req->all(),$rules);

        if($validator->fails()){
            return response()->json($validator->errors(),401);
        }
        else{

        $provider = new Provider();

        $provider->cat_id=$req->cat_id;
        $provider->username=$req->username;
        $provider->password=$req->password;
        $provider->name=$req->name;
        $provider->dob=$req->dob;
        $provider->email=$req->email;
        $provider->mobno=$req->mobno;
        
        $result=$provider->save();

        $req->file('file')->store('apiDocs');

        if($result){
            return ["result"=>"success"];
        }
        else{
            return ["result"=>"operation failed"];
        }

        }
        
        
    }

    function update(Request $req, $id){

        $provider=Provider::find($id);

        $provider->name=$req->name;
        $provider->mobno=$req->mobno;

        $result=$provider->save();

        if($result){
            return ["result"=>"success"];
        }
        else{
            return ["result"=>"operation failed"];
        }

    }

    function destroy($id){
        $provider=Provider::find($id);

        $result= $provider->delete();

        if($result){
            return ["result"=>"success"];
        }
        else{
            return ["result"=>"operation failed"];
        }


    }

    function search($name){

        return Provider::where("name","like","%".$name."%")->get();
        
       
     
    }
}
