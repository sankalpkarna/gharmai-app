<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;

//for Ajax flash message
use Session;
use View;


class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        //
        $this->middleware('permission:coupon-index|coupon-create|coupon-edit|coupon-delete', ['only' => ['index']]);
        $this->middleware('permission:coupon-create', ['only' => ['create','store']]);
        $this->middleware('permission:coupon-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:coupon-destroy', ['only' => ['destroy']]);
   
    }

    public function index(Request $req)
    {
        //
         if ($req->ajax()) {
            $coupons = Coupon::latest()->get();
            return datatables()->of($coupons)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = '<a href="coupon/edit/'.$row->id.'" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-edit"></i></a> ';
                    $html .= '<a href="javascript:void(0)"  id="' . $row->id . '" class="btn btn-danger btn-circle btn-sm delete"><i class="fas fa-trash"></i></a>';
                    return $html;
                })
                ->editColumn('expire_date',function($coupons){
                    return $coupons->expire_date;
                })
                ->editColumn('status', function ($coupons) {
                    if($coupons->status=="1"){
                        return "Active";
                    }
                    else{
                        return "InActive";
                    }
                }) 
                ->editColumn('updated_at',function($coupons){
                    return $coupons->updated_at;
                })
                // no formatting, just returned $roles->created_at; 
                ->rawColumns(['action'])
                ->make(true);
        }
        return view("coupon.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('coupon.create');

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
            'code'=>'required|string|max:255|unique:coupons',
            'discount_type' => 'required',   
            'discount' => 'required|min:2|max:100',     
            'expire_date' => 'required|date|after:tomorrow',
            'status' =>'required',
        ]);

        $coupon = Coupon::create([
            'code' => $req->code,
            'discount_type' => $req->discount_type,
            'discount' => $req->discount,
            'expire_date' => $req->expire_date,
            'status' => $req->status
        ]);

        return redirect("coupon")->with('success','Coupon Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $coupon=Coupon::findOrFail($id);
        return view('coupon.edit',compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        //
        $req->validate([
            'code'=>'required|string|max:255|unique:coupons,code,' .$id,
            'discount_type' => 'required',   
            'discount' => 'required|min:2|max:100',     
            'expire_date' => 'required|date|after:tomorrow',
            'status' =>'required',

        ]);
        $coupon=Coupon::findOrFail($id);
        $coupon->update([
            'code' => $req->code,
            'discount_type' => $req->discount_type,
            'discount' => $req->discount,
            'expire_date' => $req->expire_date,
            'status' => $req->status
        ]);
        return redirect("coupon")->with('success','Coupon Update Successful!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $coupon=Coupon::findOrFail($id);
        $coupon->delete();
      

        Session::flash('success', 'Coupon Deletion Successful!');
        return View::make('layouts/flash-message');

    }
}
