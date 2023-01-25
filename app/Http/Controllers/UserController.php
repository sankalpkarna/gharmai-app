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
                    $html = '<a href="user/edit/'.$row->id.'" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-edit"></i></a> ';
                    $html .= '<a href="user/delete/'.$row->id.'"id="' . $row->id . '" class="btn btn-danger btn-circle btn-sm delete"><i class="fas fa-trash"></i></a>';
                    return $html;
                })
                ->rawColumns(['action'])
                ->make(true);
             
        }
        return view("user.index"); 
    }

    public function add(){

        return view('user.add');
    }

    public function store(Request $req){

        $req->validate([
            'name' => 'required|min:2|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:100',
            'confirm_password' =>'required|same:password',
            'role'=>'required',            
        ]);

        $data=$req->all();

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' =>$data['role']
        ]);

        return redirect("user")->with('success','User Created Successfully!');



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
        return redirect('user')->with('success','User Deletion Successful!');
    }

    public function edit($id){
        $user = User::findOrFail($id);
        return view ("user/edit", compact('user'));
    }

    public function update(Request $req){

        $req->validate([
            'name' => 'required|min:2|max:100',
            'role'=>'required',            
        ]);

        $data=$req->all();

        User::whereId($data['id'])->update([
            'name' => $data['name'],
            'role' =>$data['role']
        ]);

        return redirect("user")->with('success','User Update Successful!');
        
    }
}

