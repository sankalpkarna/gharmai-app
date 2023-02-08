<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        //
        $this->middleware('permission:service-index|service-create|service-edit|service-delete', ['only' => ['index']]);
        $this->middleware('permission:service-create', ['only' => ['create','store']]);
        $this->middleware('permission:service-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:service-destroy', ['only' => ['destroy']]);
   
    }


    public function index(Request $req){

        //
        if ($req->ajax()) {
            $services = Service::latest()->get();
            return datatables()->of($services)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = '<a href="service/edit/'.$row->id.'" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-edit"></i></a> ';
                    $html .= '<a href="service/destroy/'.$row->id.'"id="' . $row->id . '" class="btn btn-danger btn-circle btn-sm delete"><i class="fas fa-trash"></i></a>';
                    return $html;
                })
                ->editColumn('created_at', function ($permissions) {
                return $services->created_at;}) // no formatting, just returned $roles->created_at; 
                ->rawColumns(['action'])
                ->make(true);
             
        }
        return view("service.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('service.create');
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
        //
        $req->validate([
            'name'=>'required|string|max:255|unique:permissions'
        ]);
        $service = Service::create([
            'name' => $req->name
        ]);
        return redirect("service")->with('success','Service Created Successfully!');

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
        //
        $service=Service::findOrFail($id);
        
        return view('service.edit',compact('service'));
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
            'name'  => 'required|string|max:255|unique:services',
        ]);
        $service=Service::findOrFail($id);
        $service->update([
            'name'=>$req->name,
        ]);
        return redirect("service")->with('success','Service Update Successful!');
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
        $service=Service::findOrFail($id);
        $service->delete();
        return redirect("servie")->with('success','Service Deletion Successful');   
    }
}