<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('permission:role-index|role-create|role-edit|role-delete', ['only' => ['index']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-destroy', ['only' => ['destroy']]);
    }
    public function index(Request $req)
    {
        //
            if ($req->ajax()) {
            $roles = Role::with('permissions')->latest()->get();
            return datatables()->of($roles)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = '<a href="role/edit/'.$row->id.'" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-edit"></i></a> ';
                    $html .= '<a href="role/destroy/'.$row->id.'"id="' . $row->id . '" class="btn btn-danger btn-circle btn-sm delete"><i class="fas fa-trash"></i></a>';
                    return $html;
                })
                ->editColumn('created_at', function ($roles) {
                return $roles->created_at;}) // no formatting, just returned $roles->created_at; 
                ->rawColumns(['action'])
                ->make(true);
             
        }
        return view("role.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $permissions = Permission::latest()->get();

        return view('role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        //
        $req->validate([
            'name'  => 'required|string|max:255|unique:roles'
        ]);

        $role = Role::create(['name' => $req->name]);
        $role->givePermissionTo($req->permission);
        return redirect("role")->with('success','Role Created Successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $role=Role::with('permissions')->findOrFail($id);
        $permissions = Permission::latest()->get();
        return view('role.edit',compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {

        $req->validate([
            'name'  => 'required|string|max:255',
        ]);
        $role=Role::findOrFail($id);
        $role->update([
            'name'=>$req->name,
        ]);
        $role->syncPermissions($req->permission);
        return redirect("role")->with('success','Role Update Successful!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $role=Role::with('permissions')->findOrFail($id);
        $permissions=$role->permissions->first();
        $role->revokePermissionTo($permissions);
        $role->delete();
        return redirect("role")->with('success','Role Deletion Successful');       
    }
}
