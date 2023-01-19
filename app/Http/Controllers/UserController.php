<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DataTables;
use Hash;


class UserController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $req){    
        if ($req->ajax()) {
            $users = User::latest()->get();
            return datatables()->of($users)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = '<a href="#" class="btn btn-xs btn-secondary btn-edit">Edit</a> ';
                    $html .= '<button data-rowid="' . $row->id . '" class="btn btn-xs btn-danger btn-delete">Del</button>';
                    return $html;
                })
                ->rawColumns(['action'])
                ->make(true);
             
        }
        return view("user.index"); 
    }

    public function show($id=null){

        /*
        //calling db from controller
        $data= DB::select("select * from users");
        
        //querybuilder where function
        $data=DB::table('users')->where('id',9)->get();
        
        //querybuilder find / count function
        $data=(Array)DB::table('users')->find(9);
        */
        $users = $id?User::find($id):User::all();

        
    }

    public function destroy($id){
        $user = User::find($id);
        $user->delete();
        return redirect('user/index');
    }

    public function edit($id){
        $user = User::find($id);
        return view ("user/edit", ['user'=>$user]);
    }

    public function update(Request $req){
        $user = User::find($req->id);
        $user->name=$req->username;
        $user->password=$req->password;
        $user->email=$req->email;
        $user->save();
        return redirect('user/index');
        
    }
}

