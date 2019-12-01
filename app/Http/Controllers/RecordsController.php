<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Office;
use App\Http\Requests\RecordDataRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\DB;
use URL;
use Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use DataTables;
use App\DataTables\UserDataTable;

class RecordsController extends Controller
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
    }



    public function registernewPage(UserDataTable $dataTable)
    {
        // return view('registernew');

        // The user is logged in...


        $role = Role::all();

        $dept = Office::all();

        return  $dataTable->render('user_mgt.registernew', compact('dept', 'role'));
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
    public function store(RecordDataRequest $request)
    {
        $record = new User;

        $record->first_name = $request->get('first_name');
        $record->last_name = $request->get('last_name');

        $record->name = $request->get('last_name') . ' ' . $request->get('first_name');

        $record->email = $request->get('email');
        $record->phone = $request->get('phone');

        $record->username = $request->get('username') ;
        $record->password = bcrypt($request->get('password'));
        $record->department = $request->get('department');
        $record->role = $request->get('role');

        $record->isBACSec = $request->get('bacs')?? 0;
        $record->role = $request->get('userlvl');

        $record->save();

        activity('Add User')->log('Added new record: '.$request->get('name').'-'. $request->get('department'));

        return redirect()->back()->with('flash_message', 'New user added successfully!');
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
    public function edit(UserDataTable $dataTable, $id)
    {
        //find record of given id
        $edit_form = User::find($id);
        $dept = Office::all();
        $result = DB::table('users')
                  ->where('isBACSec', '=', 1)
                  ->get();

        //show edit form and pass the info to it
        return  $dataTable->render('user_mgt.updateuser', compact('edit_form', 'dept', 'result'));
        // return View('user_mgt.updateuser',compact('edit_form','dept','result'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        //
        $Record = User::find($id);
        $Record->wholename = $request->get('wholename');
        $Record->contactno = $request->get('contact');
        $Record->department = $request->get('department');

        $Record->isBACSec = $request->get('bacs')?? 0;
        $Record->role = $request->get('userlvl');





        $Record->save();
        activity('Update User')->log('Updated Record: '.$request->get('name').'-'. $request->get('department'));
        return redirect()->route('user_mgt')->with('flash_message', 'Record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        //Find Record
        $record=User::find($id);

        //Delete the record
        $record->delete();

        //go back
        activity('Delete user')
        ->log(Auth::user()->name.' deleted user record: '.$record->name);

        return redirect()->back()->with('flash_message', 'User record deleted.');
    }
}
