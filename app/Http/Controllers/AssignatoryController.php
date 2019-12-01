<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Assignatory;
use App\Office;
use App\Http\Requests\AssignatoryRequest;
use App\Http\Requests\ActivateSignatoryRequest;
use App\Http\Requests\UpdateSignatoryRequest;
use Illuminate\Support\Facades\DB;
use Auth;
use URL;

class AssignatoryController extends Controller
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
        if (\Route::current()->getName() == 'aa') {
            # code...

            $dept = Office::all();
            $hidden_val = "AA";
            return view("signatory.signatories", compact('dept','hidden_val'));

        }elseif (\Route::current()->getName() == 'cash') {
            # code...
  
            $dept = Office::all();
            $hidden_val = "C";
            return view("signatory.signatories", compact('dept','hidden_val'));

        }elseif (\Route::current()->getName() == 'pra') {
            # code...

            $dept = Office::all();
            $hidden_val = "A";
            return view("signatory.signatories", compact('dept','hidden_val'));

        }else{

            $dept = Office::all();
            $hidden_val = "R";
            return view("signatory.signatories", compact('dept','hidden_val'));
        }
    }

    public function getPostsR(Request $request)
    {

            $records =DB::table('assignatory')->where('kind', 'R');

            return \DataTables::of($records)
            ->addColumn('action', function ($record) {
                    if ($record->status === 1) {
                        # code...
                        return '<span class="btn btn-success btn-xs" disabled><i class="glyphicon glyphicon-check"></i></span> <a href="' . URL::to('/signatory/edit/'.$record->id) .'" class="btn btn-warning btn-xs" title="Edit Signatory"><span class="glyphicon glyphicon-edit"></span></a> <a href="' . URL::to('deletesignatory/'.$record->id) .'" class="btn btn-danger btn-xs" title="Delete Signatory"><span class="glyphicon glyphicon-remove"></span></a>';

                    }else{

                         return '<a href="' . URL::to('activate/'.$record->id) .'" class="btn btn-info btn-xs" title="Mark as active?"><span class="glyphicon glyphicon-unchecked"></span></a> <a href="' . URL::to('/signatory/edit/'.$record->id) .'" class="btn btn-warning btn-xs" title="Edit Signatory"><span class="glyphicon glyphicon-edit"></span></a> <a href="' . URL::to('deletesignatory/'.$record->id) .'" class="btn btn-danger btn-xs" title="Delete Signatory"><span class="glyphicon glyphicon-remove"></span></a>';

                    }
                    
                })      
            ->make(true);              
    }

    public function getPostsA(Request $request)
    {

            $records =DB::table('assignatory')->where('kind', 'A');

            return \DataTables::of($records)
            ->addColumn('action', function ($record) {
                    if ($record->status === 1) {
                        # code...
                        return '<span class="btn btn-success btn-xs" disabled><i class="glyphicon glyphicon-check"></i></span> <a href="' . URL::to('/signatory/edit/'.$record->id) .'" class="btn btn-warning btn-xs" title="Edit Signatory"><span class="glyphicon glyphicon-edit"></span></a> <a href="' . URL::to('deletesignatory/'.$record->id) .'" class="btn btn-danger btn-xs" title="Delete Signatory"><span class="glyphicon glyphicon-remove"></span></a>';

                    }else{

                         return '<a href="' . URL::to('activate/'.$record->id) .'" class="btn btn-info btn-xs" title="Mark as active?"><span class="glyphicon glyphicon-unchecked"></span></a> <a href="' . URL::to('/signatory/edit/'.$record->id) .'" class="btn btn-warning btn-xs" title="Edit Signatory"><span class="glyphicon glyphicon-edit"></span></a> <a href="' . URL::to('deletesignatory/'.$record->id) .'" class="btn btn-danger btn-xs" title="Delete Signatory"><span class="glyphicon glyphicon-remove"></span></a>';

                    }
                    
                })      
            ->make(true);              
    }
    
    public function getPostsC(Request $request)
    {

            $records =DB::table('assignatory')->where('kind', 'C');

            return \DataTables::of($records)
            ->addColumn('action', function ($record) {
                    if ($record->status === 1) {
                        # code...
                        return '<span class="btn btn-success btn-xs" disabled><i class="glyphicon glyphicon-check"></i></span> <a href="' . URL::to('/signatory/edit/'.$record->id) .'" class="btn btn-warning btn-xs" title="Edit Signatory"><span class="glyphicon glyphicon-edit"></span></a> <a href="' . URL::to('deletesignatory/'.$record->id) .'" class="btn btn-danger btn-xs" title="Delete Signatory"><span class="glyphicon glyphicon-remove"></span></a>';

                    }else{

                         return '<a href="' . URL::to('activate/'.$record->id) .'" class="btn btn-info btn-xs" title="Mark as active?"><span class="glyphicon glyphicon-unchecked"></span></a> <a href="' . URL::to('/signatory/edit/'.$record->id) .'" class="btn btn-warning btn-xs" title="Edit Signatory"><span class="glyphicon glyphicon-edit"></span></a> <a href="' . URL::to('deletesignatory/'.$record->id) .'" class="btn btn-danger btn-xs" title="Delete Signatory"><span class="glyphicon glyphicon-remove"></span></a>';

                    }
                    
                })      
            ->make(true);              
    }

    public function getPostsAA(Request $request)
    {

            $records =DB::table('assignatory')->where('kind', 'AA');

            return \DataTables::of($records)
            ->addColumn('action', function ($record) {
                    if ($record->status === 1) {
                        # code...
                        return '<span class="btn btn-success btn-xs" disabled><i class="glyphicon glyphicon-check"></i></span> <a href="' . URL::to('/signatory/edit/'.$record->id) .'" class="btn btn-warning btn-xs" title="Edit Signatory"><span class="glyphicon glyphicon-edit"></span></a> <a href="' . URL::to('deletesignatory/'.$record->id) .'" class="btn btn-danger btn-xs" title="Delete Signatory"><span class="glyphicon glyphicon-remove"></span></a>';

                    }else{

                         return '<a href="' . URL::to('activate/'.$record->id) .'" class="btn btn-info btn-xs" title="Mark as active?"><span class="glyphicon glyphicon-unchecked"></span></a> <a href="' . URL::to('/signatory/edit/'.$record->id) .'" class="btn btn-warning btn-xs" title="Edit Signatory"><span class="glyphicon glyphicon-edit"></span></a> <a href="' . URL::to('deletesignatory/'.$record->id) .'" class="btn btn-danger btn-xs" title="Delete Signatory"><span class="glyphicon glyphicon-remove"></span></a>';

                    }
                    
                })      
            ->make(true);              
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
    public function store(AssignatoryRequest $request)
    {
        //
                                

        $Record=new Assignatory;
        $Record->name = $request->get('name');
        $Record->position = $request->get('position');
        $Record->dept = $request->get('department');
        $Record->kind = $request->get('hidden-val');
        $Record->status = $request->get('status'); 

        $Record->save();
        activity('Add Signatory')->log(Auth::user()->name.' added new signatory: '.$request->get('name').'-'. $request->get('department'));
        return redirect()->back()->with('success','New signatory added successfully!');

    }

    public function ActivateSignatory(ActivateSignatoryRequest $request,$id)
    {
        $Record = Assignatory::find($id);
        if ($Record->kind=="A" || $Record->kind=="AA" || $Record->kind=="C") {
            # code...
            $updateAssign = Assignatory::where('kind', $Record->kind)->update(['status' => 0]);
        }
        else{
            $updateAssign = Assignatory::where('dept', $Record->dept)->where('kind',$Record->kind)->update(['status' => 0]);
        }

        $query2 = Assignatory::where('id', $Record->id)->update(['status' => 1]);
        
        activity('Activate Signatory')
        ->log(Auth::user()->name.' activated signatory: '.$Record->name);
        return redirect()->back()->with('success','Signatory Activated');
        

    }

    public function DeactivateSignatory(ActivateSignatoryRequest $request,$id)
    {
        $Record = Assignatory::find($id);
        $query2 = Assignatory::where('id', $Record->id)->update(['status' => 0]);
        
        activity('Deactivate Signatory')
        ->log(Auth::user()->name.' deactivated signatory: '.$Record->name);
        return redirect()->back()->with('success','Signatory Dectivated');
        

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
        //find record of given id
        $edit_form = Assignatory::find($id);

        if($edit_form->kind == 'R'){
            $records = Assignatory::all()->where('kind', '=', 'R');
        }elseif ($edit_form->kind == 'AA') {
            # code...
            $records = Assignatory::all()->where('kind', '=', 'AA');
        }elseif ($edit_form->kind == 'C') {
            # code...
            $records = Assignatory::all()->where('kind', '=', 'C');
        }elseif ($edit_form->kind == 'A') {
            # code...
            $records = Assignatory::all()->where('kind', '=', 'A');
        }
        
        $dept = Office::all();
        

        //show edit form and pass the info to it
        return View('signatory.editsignatory', compact('edit_form','records','dept'));  
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSignatoryRequest $request, $id)
    {
        $signatory = Assignatory::find($id);
        $signatory->dept = $request->get('department');
        $signatory->name = $request->get('name');
        $signatory->position = $request->get('position');
        $signatory->save(); 
        activity('Update Signatory')->log('Updated Signatory: '.$request->get('name').'-'. $request->get('position'));
        return redirect()->back()->with('success','Signatory updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
         //Find Record
        $record=Assignatory::find($id);

        //go back
        activity('Delete Signatory')
        ->log(Auth::user()->name.' deleted signatory: '.$record->name);

        //Delete the record
        $record->delete();
        return redirect()->back()->with('success','Signatory Deleted.');
    }
}
