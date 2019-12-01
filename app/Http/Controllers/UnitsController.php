<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UnitsModel;
use App\DataTables\UnitsModelDataTable;


class UnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UnitsModelDataTable $dataTable)
    {
        //
        $unit_table = UnitsModel::all();
        return  $dataTable->render('unitsmodel.units', compact('unit_table'));
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
        $rules = [
            'iso_code' => 'required|string|max:255',
            'iso_name' => 'required|string|max:255',
        ];

        $customMessages = [
            'iso_code.required' => '"ISO Code" is Required.',
            'iso_name.required' => '"Unit Name" is Required.', 
        ];

        $this->validate($request, $rules, $customMessages);


        $add_unit = new UnitsModel;
        $add_unit->iso_code = $request->get('iso_code');
        $add_unit->iso_name = $request->get('iso_name');
        $add_unit->iso_description = $request->get('iso_description');
        $add_unit->save();

        return redirect()->back()->with('flash_message','Unit Saved!');

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
    public function edit(UnitsModelDataTable $dataTable,$id)
    {
        //
        $unit_edit = UnitsModel::find($id);
        return $dataTable->render('unitsmodel.units_edit',compact('unit_edit'));
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
        $rules = [
            'iso_code' => 'required|string|max:255',
            'iso_name' => 'required|string|max:255',
        ];

        $customMessages = [
            'iso_code.required' => '"ISO Code" is Required.',
            'iso_name.required' => '"Unit Name" is Required.', 
        ];

        $this->validate($request, $rules, $customMessages);

        $unit_update = UnitsModel::find($id);
        $unit_update->iso_code = $request->get('iso_code');
        $unit_update->iso_name = $request->get('iso_name');
        $unit_update->iso_description = $request->get('iso_description');
        $unit_update->save();
        return redirect()->route('unit.view')->with('flash_message','Unit Updated!');
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
        $unit_delete = UnitsModel::find($id);
        $unit_delete->delete();
        return redirect()->back()->with('flash_message','Unit Deleted');
    }
}
