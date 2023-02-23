<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;

//for Ajax flash message
use Session;
use View;


class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        //
        $this->middleware('permission:tax-index|tax-create|tax-edit|tax-delete', ['only' => ['index']]);
        $this->middleware('permission:tax-create', ['only' => ['create','store']]);
        $this->middleware('permission:tax-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:tax-destroy', ['only' => ['destroy']]);
   
    }

    public function index(Request $req)
    {
        //
         if ($req->ajax()) {
            $taxes = Tax::latest()->get();
            return datatables()->of($taxes)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = '<a href="tax/edit/'.$row->id.'" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-edit"></i></a> ';
                    $html .= '<a href="javascript:void(0)"  id="' . $row->id . '" class="btn btn-danger btn-circle btn-sm delete"><i class="fas fa-trash"></i></a>';
                    return $html;
                })
                ->editColumn('title',function($taxes){
                    return $taxes->title;
                })
                ->editColumn('type',function($taxes){
                    return $taxes->type;
                })
                ->editColumn('value',function($taxes){
                    return $taxes->value;
                })
                ->editColumn('status', function ($taxes) {
                    if($taxes->status=="1"){
                        return "Active";
                    }
                    else{
                        return "InActive";
                    }
                }) 
                ->editColumn('updated_at',function($taxes){
                    return $taxes->updated_at;
                })
                // no formatting, just returned $roles->created_at; 
                ->rawColumns(['action'])
                ->make(true);
        }
        return view("tax.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('tax.create');

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
            'title'=>'required|string|max:255|unique:taxes',
            'type' => 'required',    
            'value' => 'required|min:1|max:100',            
            'status' =>'required',
        ]);
        $tax = Tax::create([
            'title' => $req->title,
            'type' => $req->type,
            'value' => $req->value,
            'status' => $req->status
        ]);

        return redirect("tax")->with('success','Tax Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function show(Tax $tax)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $tax=Tax::findOrFail($id);
        return view('tax.edit',compact('tax'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        //
         $req->validate([
            'title'=>'required|string|max:255|unique:taxes,title,' . $id,
            'type' => 'required',    
            'value' => 'required|min:1|max:100', 
            'status' =>'required',
        ]);
        $tax=Tax::findOrFail($id);
        $tax->update([
            'title'=>$req->title,
            'type' => $req->type,
            'value' => $req->value,
            'status' => $req->status
        ]);
        return redirect("tax")->with('success','Tax Update Successful!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $tax=Tax::findOrFail($id);
        $tax->delete();
      
        Session::flash('success', 'Tax Deletion Successful!');
        return View::make('layouts/flash-message');
    }
}
