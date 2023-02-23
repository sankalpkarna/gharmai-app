<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

//for Ajax flash message
use Session;
use View;


class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('permission:permission-index|permission-create|permission-edit|permission-delete', ['only' => ['index']]);
        $this->middleware('permission:permission-create', ['only' => ['create','store']]);
        $this->middleware('permission:permission-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:permission-destroy', ['only' => ['destroy']]);
    }
    public function index(Request $req)
    {
        //
        if ($req->ajax()) {
            $permissions = Permission::latest()->get();
            return datatables()->of($permissions)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = '<a href="permission/edit/'.$row->id.'" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-edit"></i></a> ';
                    $html .= '<a href="javascript:void(0)" id="' . $row->id . '" class="btn btn-danger btn-circle btn-sm delete"><i class="fas fa-trash"></i></a>';
                    return $html;
                })
                ->editColumn('updated_at', function ($permissions) {
                return $permissions->updated_at;}) // no formatting, just returned $roles->created_at; 
                ->rawColumns(['action'])
                ->make(true);
             
        }
        return view("permission.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("permission.create");
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
            'name'=>'required|string|max:255|unique:permissions'
        ]);
        $Permission = Permission::create([
            'name' => $req->name
        ]);
        return redirect("permission")->with('success','Permission Created Successfully!');

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
        $permission=Permission::findOrFail($id);
        
        return view('permission.edit',compact('permission'));
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
        //
        $req->validate([
            'name'  => 'required|string|max:255|unique:permissions',
        ]);
        $permission=Permission::findOrFail($id);
        $permission->update([
            'name'=>$req->name,
        ]);
        return redirect("permission")->with('success','Permission Update Successful!');
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
        $permission=Permission::findOrFail($id);
        $permission->delete();
        Session::flash('success', 'Permission Deletion Successful!');
        return View::make('layouts/flash-message');
        
        //return redirect("permission")->with('success','Permission Deletion Successful');   
    }
}
