<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SoleDist;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use response;
use Auth;

class SoleDistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }


    public function index()
    {
        //
        $records = SoleDist::all();
        return view('soledist')->with('records',$records);
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
        $Record=new SoleDist;
        $Record->name = $request->get('name');
        $Record->address = $request->get('address');
        $filename= $request->certificate->getClientOriginalName();
        $path = $request->certificate->storeAs("certificate", $filename, "public");
        $Record->file_name = $path;
        $Record->save();
        return redirect()->back()->with('flash_message','Sole Distributor added successfully!');
    }

    public function edit($id)
    {
        //
        
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Find Record
        $record=SoleDist::find($id);

        //Delete the record
        $record->delete();
      
        //go back
        activity('Delete Distributor')
        ->log('Deleted distributor: '.$record->name);

        return redirect()->back()->with('flash_message','Sole Distributor deleted.');
    }
}
