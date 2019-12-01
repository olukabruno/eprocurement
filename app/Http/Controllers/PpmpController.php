<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Ppmp;
use App\PpmpItem;
use App\User;
use App\UnitsModel;
use App\DataTables\PpmpDataTable;
use App\Http\Requests\PpmpItemsRequest;
use App\Assignatory;
use Auth;
use PDF;
class PpmpController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PpmpDataTable $dt1)
    {
        return $dt1->render('PPMP.ViewAll', compact('dt1'));
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
        $rules = [
            'year' => 'required|date_greater_than:1990',
        ];

        $this->validate($request, $rules);

        $query = Ppmp::where('ppmp_year', '=', $request->get('year'))->where('user_id','=',Auth::id());

        if ($query->exists()) {
           return redirect()->back()->with('error', 'PPMP already exists!');
        }

        $user = User::findorFail(Auth::id());
        $ppmp = $user->ppmp()->create([
            'ppmp_year' => $request->get('year'),
            'department' => $user->department,
        ]);

        return redirect()->back()->with('success', 'PPMP Generated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Ppmp::findorFail( $id );
        $model->delete();

        return redirect()->back()->with('info', 'PPMP Deleted');
    }

    /**
     * Activate the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activate($id)
    {
        $model = Ppmp::findorFail( $id );
        
        $deactivate = Ppmp::where('is_activated', 1)->where('department', Auth::user()->department)->update(['is_activated' => 0]);
        $activate = Ppmp::where('id', $model->id)->update(['is_activated' => 1]);

        return redirect()->back()->with('success', 'PPMP Activated');
    }

    /**
     * Deactivate the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deactivate($id)
    {
         $model = Ppmp::findorFail( $id );
        

        Ppmp::where('id', $model->id)->update(['is_activated' => 0]);

        return redirect()->back()->with('info', 'PPMP Deactivated');
    }

    // PPMP ITEMS ====================================================================================

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ppmp = Ppmp::findorFail($id);
        $collection = $ppmp->ppmpItems->values()->groupBy('code')->chunk(100);
        $officer = Assignatory::where('dept',Auth::user()->department)->where('kind','R')->where('status', "=", 1)->first();

        $options = [
            'margin-top'    => 10,
            'margin-right'  => 10,
            'margin-bottom' => 10,
            'margin-left'   => 10,
        ];

        $pdf = PDF::loadView('PPMP.Print',compact('officer','collection'))->setPaper('Folio');

        foreach ($options as $margin => $value) {
            $pdf->setOption($margin, $value);
        }
        return $pdf->stream('PPMP.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ppmp = Ppmp::findorFail($id);
        $ppmp_id = $id;
        $collect = $ppmp->ppmpItems;
        $grouped = $collect->groupBy('code');
        $units = UnitsModel::all();
        return view('PPMP.ViewItems', compact('ppmp_id','units','grouped','ppmp'));
    }

    /**
     * Store items in the specified resource in the storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeItems(PpmpItemsRequest $request, $id)
    {   
        $input = $request->all();
        $schedule = implode(",", $input['schedule']);

        $ppmp = Ppmp::find($id);

        $ppmp_item = $ppmp->ppmpItems()->create([
                'code' => $input['code'],
                'description' => $input['description'],
                'qty' => $input['quantity'],
                'unit' => $input['unit'],
                'estimated_budget' => $input['estimated_budget'],
                'procurement_mode' => $input['mode'],
                'inventory' => (int)$input['quantity'],
                'remaining_budget' => $input['estimated_budget'],
                'schedule' => $schedule,
        ]);
        
        
        if($ppmp_item == true){

            $items = $ppmp->ppmpItems()->where('code','<>','OTHER PROGRAMS CHARGEABLE AGAINST RELEVANT OFFICES')->get();
            $ppmp->estimated_budget = $items->sum('estimated_budget');
            $ppmp->remaining_budget = $items->sum('estimated_budget');
            $check = $ppmp->save();
            return redirect()->back()->with('success', 'PPMP Item Added');

        }
        return redirect()->back()->with('danger', 'PPMP Item Failed to add');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editItems($ppmp_id, $id)
    {
        $ppmp = Ppmp::findorFail($ppmp_id);
        $collect = $ppmp->ppmpItems;
        $grouped = $collect->groupBy('code');
        $units = UnitsModel::all();

        $item_data = $ppmp->ppmpItems->where('id',$id)->first();
        return view('PPMP.EditItems', compact('units','id','grouped','item_data','ppmp_id','ppmp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PpmpItemsRequest $request, $ppmp_id, $id)
    {
        $input = $request->all();
        $schedule = implode(",", $input['schedule']);
        $ppmp = Ppmp::findorFail($ppmp_id);

        $ppmp_item = $ppmp->ppmpItems()->where('id','=',$id)->update([

            'code' => $input['code'],
            'description' => $input['description'],
            'qty' => $input['quantity'],
            'unit' => $input['unit'],
            'estimated_budget' => $input['estimated_budget'],
            'remaining_budget' => $input['estimated_budget'],
            'procurement_mode' => $input['mode'],
            'inventory' => $input['quantity'],
            'schedule' => $schedule,
        ]);

        if($ppmp_item == true){

            $items = $ppmp->ppmpItems()->where('code','<>','OTHER PROGRAMS CHARGEABLE AGAINST RELEVANT OFFICES')->get();
            $ppmp->estimated_budget = $items->sum('estimated_budget');
            $ppmp->remaining_budget = $items->sum('estimated_budget');
            $check = $ppmp->save();
            return redirect()->route('ppmp.edit',$ppmp_id)->with('success', 'PPMP successfully updated');

        }
        return redirect()->route('ppmp.edit',$ppmp_id)->with('danger', 'PPMP failed to update');

        


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyItems($ppmp_id,$id)
    {
        PpmpItem::destroy($id);
        return redirect()->back()->with('info','Item removed');

    }

    //================================================================================================

}
