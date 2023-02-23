<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;

//for Ajax flash message
use Session;
use View;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        //
        $this->middleware('permission:document-index|document-create|document-edit|document-delete', ['only' => ['index']]);
        $this->middleware('permission:document-create', ['only' => ['create','store']]);
        $this->middleware('permission:document-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:document-destroy', ['only' => ['destroy']]); 

    }
    public function index(Request $req){
        //
        if ($req->ajax()) {
            $documents = Document::latest()->get();
            return datatables()->of($documents)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = '<a href="document/edit/'.$row->id.'" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-edit"></i></a> ';
                    $html .= '<a href="javascript:void(0)"  id="' . $row->id . '" class="btn btn-danger btn-circle btn-sm delete"><i class="fas fa-trash"></i></a>';
                    return $html;
                })
                ->editColumn('name',function($documents){
                    return $documents->name;
                })
                ->editColumn('status', function ($documents) {
                    if($documents->status=="1"){
                        return "Active";
                    }
                    else{
                        return "InActive";
                    }
                }) 
                // no formatting, just returned $roles->created_at; 
                ->rawColumns(['action'])
                ->make(true);
        }
        return view("document.index");
  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('document.create');
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
            'name'=>'required|string|max:255|unique:documents',          
            'status' =>'required',
        ]);

        $document = Document::create([
            'name' => $req->name,
            'status' => $req->status
        ]);
        return redirect("document")->with('success','Document Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $document=Document::findOrFail($id);
        return view('document.edit',compact('document'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        //
        $req->validate([
            'name'=>'required|string|max:255|unique:documents,name,' . $id,
            'status' =>'required',
        ]);
        $document=Document::findOrFail($id);
        $document->update([
            'name'=>$req->name,
            'status' => $req->status
        ]);
        return redirect("document")->with('success','Document Update Successful!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $document=Document::findOrFail($id);
        $document->delete();
      
        Session::flash('success', 'Document Deletion Successful!');
        return View::make('layouts/flash-message');

    }
}
