<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DataTables;
use Hash;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function __construct(){
        $this->middleware('permission:user-index|user-create|user-edit|user-delete', ['only' => ['index']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-destroy', ['only' => ['destroy']]);     
    }

    public function index(Request $req){   

     /*   $users = User::With('roles')->latest()->get();
        echo("<pre>");
        print_r(json_decode($users));
        echo("</pre>");
        die();*/

        if ($req->ajax()) {
            $users = User::With('roles')->latest()->get();
            return datatables()->of($users)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = '<a href="user/edit/'.$row->id.'" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-edit"></i></a> ';
                    $html .= '<a href="user/destroy/'.$row->id.'"id="' . $row->id . '" class="btn btn-danger btn-circle btn-sm delete"><i class="fas fa-trash"></i></a>';
                    return $html;
                })
                ->editColumn('created_at', function ($users) {
                return $users->created_at;}) // no formatting, just returned $users->created_at; 
                ->rawColumns(['action'])
                ->make(true);             
        }
        return view("user.index"); 
    }

    public function create(){
        $roles = Role::latest()->get();
        return view('user.create',compact('roles'));
    }

    public function store(Request $req){
        $req->validate([
            'name' => 'required|min:2|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:100',
            'confirm_password' =>'required|same:password',
            'role'=>'required',

        ]);
        $user=User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => Hash::make($req->password),
        ]);
        $user->assignRole($req->role);
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

    public function edit($id){
        $user = User::with('roles')->findOrFail($id);
        $roles = Role::latest()->get();
        return view ("user/edit", compact('user','roles'));
    }

    public function update(Request $req){
        $req->validate([
            'name' => 'required|min:2|max:100',
            'role'=>'required',            
        ]);
        $user=User::findOrFail($req->id);
        $user->update([
            'name' => $req->name,
        ]);
        $user->syncRoles($req->role);
        return redirect("user")->with('success','User Update Successful!');        
    }

    public function destroy($id){
        $user = User::With('roles')->findOrFail($id);
        // return $user->roles;
        $role=$user->roles->first();
        $user->removeRole($role);
        $user->delete();
        return redirect('user')->with('success','User Deletion Successful!');
    }
}

