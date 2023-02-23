<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\User;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        //
        $this->middleware('permission:customer-index|customer-create|customer-edit|customer-delete', ['only' => ['index']]);
        $this->middleware('permission:customer-create', ['only' => ['create','store']]);
        $this->middleware('permission:customer-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:customer-destroy', ['only' => ['destroy']]);
   
    }

    public function index(Request $req)
    {
        //
        if ($req->ajax()) {
            $customers = User::role('customer')->get();
            return datatables()->of($customers)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = '<a href="customer/edit/'.$row->id.'" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-edit"></i></a> ';
                    $html .= '<a href="javascript:void(0)"  id="' . $row->id . '" class="btn btn-danger btn-circle btn-sm delete"><i class="fas fa-trash"></i></a>';
                    return $html;
                })
                ->editColumn('email',function($customers){
                    return $customers->email;
                })
                ->editColumn('mobile_number', function ($customers) {
                    return $customers->mobile_number;
                }) 
                ->editColumn('updated_at',function($customers){
                    return $customers->updated_at;
                })
                // no formatting, just returned $roles->created_at; 
                ->rawColumns(['action'])
                ->make(true);
        }
        return view("customer.index");
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
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user= User::find($id);  
        $customer = Customer::where('user_id', $id)->first();        
        return view ("customer/edit", compact('user','customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        //
        $req->validate([
            'status' =>'required',
            'profile_image' => 'image|mimes:png,jpg,jpeg|max:2048',
            
        ]);
        $customer = Customer::where('user_id', $id)->first();    
        if(!is_null($customer)){
            $customer->update([
                'status'=>$req->status,
            ]);    
        }
        else{
            $customer = Customer::create([
                'user_id'=>$id,
                'status'=>$req->status,
            ]);
        }
        
        if($req->file('profile_image')){

            $req->file('profile_image')->storeAs('public/users',$id);    
        }
        return redirect()->route('customer.edit',['id'=>$id])->with('success','Customer Update Successful!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
