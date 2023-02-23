<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provider;
use App\Models\User;
use App\Models\Document;
use App\Models\Service;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

//for Ajax flash message
use Session;
use View;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        //
        $this->middleware('permission:provider-index|provider-create|provider-edit|provider-delete', ['only' => ['index']]);
        $this->middleware('permission:provider-create', ['only' => ['create','store']]);
        $this->middleware('permission:provider-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:provider-destroy', ['only' => ['destroy']]);
   
    }
    public function index(Request $req)
    {    
        //
        if ($req->ajax()) {
            $providers = User::role('provider')->get();
            return datatables()->of($providers)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = '<a href="provider/edit/'.$row->id.'" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-edit"></i></a> ';
                    $html .= '<a href="javascript:void(0)"  id="' . $row->id . '" class="btn btn-danger btn-circle btn-sm delete"><i class="fas fa-trash"></i></a>';
                    return $html;
                })
                ->editColumn('email',function($providers){
                    return $providers->email;
                })
                ->editColumn('mobile_number', function ($providers) {
                    return $providers->mobile_number;
                }) 
                ->editColumn('updated_at',function($providers){
                    return $providers->updated_at;
                })
                // no formatting, just returned $roles->created_at; 
                ->rawColumns(['action'])
                ->make(true);
        }
        return view("provider.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show(Provider $provider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user= User::find($id);  
        $provider = Provider::where('user_id', $id)->first();        
        $documents = Document::where('status','1')->latest()->get();
        $services = Service::where('status','1')->latest()->get();
        return view ("provider/edit", compact('user','provider','documents','services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        //
        $req->validate([
            'service_id' => 'required',
            'document_id' => 'required',
            'document_number' => 'required|string|max:255',
            'status' =>'required',
            'profile_image' => 'image|mimes:png,jpg,jpeg|max:2048',
            'document_image' => 'image|mimes:png,jpg,jpeg|max:2048'
        ]);
        $provider = Provider::where('user_id', $id)->first();    
        if(!is_null($provider)){
            $provider->update([
                'service_id'=>$req->service_id,
                'document_id'=>$req->document_id,
                'document_number'=>$req->document_number,
                'status'=>$req->status,
            ]);    
        }
        else{
            $provider = Provider::create([
                'user_id'=>$id,
                'service_id'=>$req->service_id,
                'document_id'=>$req->document_id,
                'document_number'=>$req->document_number,
                'status'=>$req->status,
            ]);
        }
        
        if($req->file('profile_image')){

            $req->file('profile_image')->storeAs('public/users',$id);    
        }

        if($req->file('document_image')){

            $req->file('document_image')->storeAs('public/documents',$id);    
        }
        return redirect()->route('provider.edit',['id'=>$id])->with('success','Provider Update Successful!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provider $provider)
    {
        //
    }
}
