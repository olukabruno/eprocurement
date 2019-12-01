<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AbstractModel;
use App\PurchaseRequestModel;
use App\PurchaseRequestItemModel;
use App\DataTables\abstractcloseprDataTable;
use App\DataTables\abstractmodelDataTable;
use App\abstractitemmodel;
use App\abstractsupplier;
use App\abstractprice;
use App\Office;
use App\User;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;
use PDF;
use App\PpmpItem;
class AbstractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(abstractmodelDataTable $dt1, abstractcloseprDataTable $dt2)
    {
        if (request()->get('table') == 'purchase_request') {
            return $dt2->render('abstract.abstract-view', compact('dt1', 'dt2'));
        }
        return $dt1->render('abstract.abstract-view', compact('dt1', 'dt2'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,$id)
    {
        //
        $pr = PurchaseRequestModel::find($id);
        $pr->created_abstract = 1;

        $abstract = new AbstractModel;
        $abstract->created_by = Auth::user()->id;
        $abstract->abstract_title = "A-".$pr->pr_unique;
        $abstract->pr_number = $pr->pr_form_no;
        $abstract->proc_details = strtoupper($request->get('proc_details'));
        $abstract->office = Auth::user()->department;
        $abstract->requestor_name = $pr->requestor_name;

        $abstract->save();

        
       $data = PurchaseRequestItemModel::where('pr_form_number',$pr->pr_form_no)->get();

        foreach($data as $datas){
            $query = AbstractModel::where('pr_number',$pr->pr_form_no)->firstorFail(); 
            $ppmpitem = PpmpItem::find($datas->pr_description);
            abstractitemmodel::create([
                'abstract_id' => $query->id,
                'qty' => $datas->pr_qty,
                'unit' =>$datas->pr_unit,
                'particulars' =>$ppmpitem->description
            ]);
        }

        
        $pr->save();

        activity('Create Abstract of Quotation')
        ->log('Generated Abstract of Quotation Form: A-'.$pr->pr_unique);

        return redirect()->back()->with('success','Abstract of Quotation Form Generated!');



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
            'abstract_id' => 'required',
            'supplier_address' => 'required|string|max:180',
            'supplier_name' => 'required|string|max:180',
            'item' => 'required',
            'canv_dept' => 'required',
            'canv_name' => 'required',

        ];

        $customMessages = [

            'abstract_id.required' => 'Abstract ID is required.',
            'item.required' => 'Item Number is required.',
            'unit_price.required' => 'Unit Price is required.',
            'supplier_address.required' => 'Supplier Address is required.',
            'supplier_name.required' => 'Supplier Name is required.',
            'canv_name.required' => 'Canvasser Name is required.',
            'canv_name.dept' => 'Canvasser Department is required.',


        ];

        $this->validate($request, $rules, $customMessages);

        $input = $request->all();

        $list =PurchaseRequestItemModel::all()->where('pr_form_number', $input['abstract_pr']);
        $grand_total = $list->sum('pr_estimated_cost'); 
        $count = sizeof($input['item']);

        $model = abstractsupplier::create([
            'abstract_id' => $input['abstract_id'],
            'supplier' => strtoupper($input['supplier_name']),
            'supplier_address' =>strtoupper($input['supplier_address']),
            'canvasser_name' =>ucfirst($input['canv_name']),
            'canvasser_department' =>$input['canv_dept'],
        ]);

        

        $supplier_id = array();
        $abs_id = array();
        for ($i=0; $i < $count ; $i++) { 
            $supplier_id[] = $model->id;
        }
         for ($i=0; $i < $count ; $i++) { 
            $abs_id[] = $input['abstract_id'];
        }

        foreach($input['item'] as $i=> $value ){

        abstractprice::create([
            'abstract_id'=>$abs_id[$i],
            'supplier_id'=>$supplier_id[$i],
            'item_id' =>$value,
            'unit_price' =>$input['unit_price'][$i],
            'total_price' =>$input['unit_price'][$i] * $input['qty'][$i]
        ]);

        }

        return redirect()->back()->with('success','Supplier Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $abstract = AbstractModel::find($id);
        $pr = PurchaseRequestModel::where('pr_form_no',$abstract->pr_number)->first();
        $office = Office::all();
        $pr_item = PurchaseRequestItemModel::all()->where('pr_form_number',$abstract->pr_number);

        $grand_total = $pr_item->sum('pr_estimated_cost');

        $abstract_items = abstractitemmodel::all()->where('abstract_id',"=",$abstract->id);
        
        $query= DB::table('abstract_supplier')->where('abstract_id',"=",$abstract->id)->paginate(3);

        $as = abstractsupplier::all()->where('abstract_id',"=",$abstract->id)->where('selected', '=', '1')->count();

        $select_bidder = abstractsupplier::all()->where('abstract_id',"=",$abstract->id);

        $selected_bidder = abstractsupplier::where('abstract_id',"=",$abstract->id)->where('selected','=',1)->first();
        

        return view('abstract.abstract-form',compact('pr','abstract','abstract_items','pr_item','grand_total','office','query','select_bidder','selected_bidder', 'as'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $abstract_supplier = abstractsupplier::find($id);
        $abstract_items = DB::table('abstract_items')
                        ->select('abstract_items.id','abstract_items.particulars','abstract_items.qty','abstract_items.unit', 'abstract_price.unit_price','abstract_price.total_price','abstract_items.abstract_id','abstract_price.supplier_id')
                        ->join('abstract_price', 'abstract_price.item_id', '=', 'abstract_items.id')
                        ->where('abstract_items.abstract_id','=',$abstract_supplier->abstract_id)
                        ->where('abstract_price.supplier_id','=',$id)
                        ->get();

        return response()->json([$abstract_supplier,$abstract_items]);
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
            'bidder' => 'required',
            'reason' => 'required',
            'notes' => 'required|string|max:180',
        ];

        $customMessages = [

            'bidder.required' => 'Choose selected bidder.',
            'reason.required' => 'Please choose why the bidder was selected',
            'notes.required' => 'Please indicate notes on why the bidder was selected.',
        ];

        $this->validate($request, $rules, $customMessages);

        $update_abstract = AbstractModel::find($id);
        $update_abstract->reason = $request->get('reason');
        $update_abstract->notes = $request->get('notes');
        $update_abstract->save();

        if($update_abstract->save() === true){
            $suppliers = DB::table('abstract_supplier')->where('abstract_id','=',$id)->where('selected','=','1')
            ->update(['selected' => 0]);
            $update_supplier = abstractsupplier::find($request->get('bidder'));
            $update_supplier->selected = 1;
            $update_supplier->save();
        }else{
            return redirect()->back()->with('errors','Select a Bidder');
        }


        activity('Update Abstract')
        ->log('Updated Abstract Form on PR#'.$update_abstract->pr_number);
        return redirect()->back()->with('success','Abstract Updated');
        // return redirect()->route('abstract.print',$update_abstract->pr_number);
    }

     /**
     * Update the suppliers in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateSupplier(Request $request, $id)
    {
        $rules = [
            'abstract_id2' => 'required',
            'supplier_address2' => 'required|string|max:180',
            'supplier_name2' => 'required|string|max:180',
            'edit_item' => 'required',
            'edit_qty' => 'required',
            'edit_price' => 'required',
            'canv_dept2' => 'required',
            'canv_name2' => 'required',

        ];

        $customMessages = [

            'abstract_id.required' => 'Abstract ID is required.',
            'edit_item.required' => 'Item Number is required.',
            'edit_price.required' => 'Unit Price is required.',
            'supplier_address.required' => 'Supplier Address is required.',
            'supplier_name.required' => 'Supplier Name is required.',
            'canv_name.required' => 'Canvasser Name is required.',
            'canv_name.dept' => 'Canvasser Department is required.',


        ];

        $this->validate($request, $rules, $customMessages);

        $input = $request->all();

        // $list =PurchaseRequestItemModel::all()->where('pr_form_number', $input['abstract_pr']);
        // $grand_total = $list->sum('pr_estimated_cost'); 
        $count = sizeof($input['edit_item']);

        $model = DB::table('abstract_supplier')->where('id', '=', $input['supplier_id2'])
        ->update([
            'abstract_id' => $input['abstract_id2'],
            'supplier' => strtoupper($input['supplier_name2']),
            'supplier_address' =>strtoupper($input['supplier_address2']),
            'canvasser_name' =>ucfirst($input['canv_name2']),
            'canvasser_department' =>$input['canv_dept2'],
        ]);

        $supplier_id = array();
        $abs_id = array();
        for ($i=0; $i < $count ; $i++) { 
            $supplier_id[] = $input['supplier_id2'];
        }
         for ($j=0; $j < $count ; $j++) { 
            $abs_id[] = $input['abstract_id2'];
        }

        foreach($input['edit_item'] as $k=> $value2 ){

        $model = DB::table('abstract_price')
        ->where('supplier_id', '=', $input['supplier_id2'])
        ->where('abstract_id', '=', $input['abstract_id2'])
        ->where('item_id','=',$value2)
        ->update([
            'unit_price' =>$input['edit_price'][$k],
            'total_price' =>$input['edit_price'][$k] * $input['edit_qty'][$k]
        ]);

        }


        activity('Update Abstract')
        ->log('Updated Supplier');
        return redirect()->back()->with('success','Updated Supplier');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $abstract_cancel = AbstractModel::find($id);
        $abstract_supplier = abstractsupplier::where('abstract_id','=',$abstract_cancel->id);
        $abstract_items = abstractitemmodel::where('abstract_id','=',$abstract_cancel->id);
        $abstract_prices = abstractprice::where('abstract_id','=',$abstract_cancel->id);

        $abstract_prices->delete();
        $abstract_supplier->delete();
        $abstract_items->delete();

        $pr_reset = PurchaseRequestModel::
            where('pr_form_no', $abstract_cancel->pr_number)
            ->update(['created_abstract' => 0]);


        $abstract_cancel->delete();

        activity('Delete Abstract')
        ->log('Deleted Abstract Form on PR#'.$abstract_cancel->pr_number);
        return redirect()->back()->with('success','Abstract of Quotation Cancelled.');

    }

      /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteSupplier($id)
    {
        $supplier_price = abstractprice::where('supplier_id','=',$id);
        $supplier_price->delete();
        $supplier_delete = abstractsupplier::find($id);
        $supplier_delete->delete();

        activity('Delete Supplier')
        ->log('Deleted Supplier with ID# '.$id);
        return redirect()->back()->with('success','Supplier Deleted');


    }

     /**
     * Print Abstract of Quotation Form
     *
     * @param  string  $form_no
     * @return \Illuminate\Http\Response
     */

    public function print($form_no)
    {

        $abstract = AbstractModel::where('pr_number',$form_no)->first();

        $count_all = abstractitemmodel::all()->where('abstract_id','=',$abstract->id)->count();
        
        $abstract_items = abstractitemmodel::all()->where('abstract_id','=',$abstract->id)->chunk(15);

        $abstract_supplier = abstractsupplier::all()->where('abstract_id',$abstract->id)->chunk(3);

        $selected_bidder = abstractsupplier::where('abstract_id',$abstract->id)->where('selected',1)->first();

        $pr_item = PurchaseRequestItemModel::all()->where('pr_form_number',$abstract->pr_number);

        $estimated_total = $pr_item->sum('pr_estimated_cost');

        $dt   = Carbon::parse($abstract->created_at);

        $created_code = Auth::User()->department."/".Auth::User()->wholename."/".$dt->Format('F j, Y')."/".$dt->format("g:i:s A")."/"."BAC"."/".$form_no;

        $options = [
            'margin-top'    => 5,
            'margin-right'  => 2,
            'margin-bottom' => 5,
            'margin-left'   => 2,
        ];

        $pdf = PDF::loadView('abstract.abstract-print',compact('estimated_total','abstract_items','abstract_supplier','abstract','created_code','selected_bidder','count_all'))
        ->setOption("footer-left",$created_code);

        foreach ($options as $margin => $value) {
            $pdf->setOption($margin, $value);
        }

        return $pdf->stream($form_no.'.pdf');

    }
}
