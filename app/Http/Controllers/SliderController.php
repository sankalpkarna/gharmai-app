<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;

//for Ajax flash message
use Session;
use View;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        //
        $this->middleware('permission:slider-index|slider-create|slider-edit|slider-delete', ['only' => ['index']]);
        $this->middleware('permission:slider-create', ['only' => ['create','store']]);
        $this->middleware('permission:slider-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:slider-destroy', ['only' => ['destroy']]);
   
    }

    public function index(Request $req)
    {
        //
         if ($req->ajax()) {
            $sliders = Slider::latest()->get();
            return datatables()->of($sliders)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = '<a href="slider/edit/'.$row->id.'" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-edit"></i></a> ';
                    $html .= '<a href="javascript:void(0)"  id="' . $row->id . '" class="btn btn-danger btn-circle btn-sm delete"><i class="fas fa-trash"></i></a>';
                    return $html;
                })
                ->editColumn('description',function($sliders){
                    return $sliders->description;
                })
                ->editColumn('status', function ($sliders) {
                    if($sliders->status=="1"){
                        return "Active";
                    }
                    else{
                        return "InActive";
                    }
                }) 
                ->editColumn('updated_at',function($sliders){
                    return $sliders->updated_at;
                })
                // no formatting, just returned $roles->created_at; 
                ->rawColumns(['action'])
                ->make(true);
        }
        return view("slider.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('slider.create');

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
            'title'=>'required|string|max:255|unique:sliders',
            'description' => 'required',            
            'status' =>'required',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'

        ]);

        $slider = Slider::create([
            'title' => $req->title,
            'description' => $req->description,
            'status' => $req->status
        ]);

        $req->file('image')->storeAs('public/sliders',$slider->id);

        return redirect("slider")->with('success','Slider Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $slider=Slider::findOrFail($id);
        return view('slider.edit',compact('slider'));
 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        //
         $req->validate([
            'title'=>'required|string|max:255|unique:sliders,title,' . $id,
            'description' => 'required',
            'status' =>'required',
            'image' => 'image|mimes:png,jpg,jpeg|max:2048'

        ]);
        $slider=Slider::findOrFail($id);
        $slider->update([
            'title'=>$req->title,
            'description'=>$req->description,
            'status' => $req->status
        ]);
        if($req->file('image')){

            $req->file('image')->storeAs('public/sliders',$id);    
        }
        return redirect("slider")->with('success','Slider Update Successful!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $slider=Slider::findOrFail($id);
        $slider->delete();
      
        Session::flash('success', 'Slider Deletion Successful!');
        return View::make('layouts/flash-message');
    }
}
