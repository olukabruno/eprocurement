<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Office;
use App\User;
use App\Assignatory;
use App\PurchaseRequestModel;
use App\PurchaseRequestItemModel;
use App\PpmpItem;
use App\UnitsModel;
use Auth;
use DB;
use Session;
use PDF;

use Carbon\Carbon;

class PurchaseRequestItemController extends Controller
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $pr = PurchaseRequestModel::findorFail($id);
        $list = $pr->prItems()->get();
        $count = $list->count() + 1;
        $grand_total = $list->sum('pr_estimated_cost');
        $units = UnitsModel::all();

        return view('pr.pr-items',compact('pr','list','count','grand_total','units'));

    }

        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show2($id)
    {

        $pr = PurchaseRequestModel::findorFail($id);
        $list = $pr->prItems()->get();
        $count = $list->count() + 1;
        $grand_total = $list->sum('pr_estimated_cost');
        $units = UnitsModel::all();

        return view('pr.pr-close-items',compact('pr','list','count','grand_total','units'));

    }


    public function getData($id)
    {
        $pr = PpmpItem::findorFail($id);
        return json_encode($pr);
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
            'prid' => 'required|string|max:255',
            'itemqty' => 'required|numeric',
            'itemunit' => 'required',
            'itemdescription' => 'required|string|max:255',
            'itemcpu' => 'required|numeric',
        ];

        $customMessages = [
            'prid.required' => 'PR Number is missing.',
            'itemqty.required' => 'Item quantity is required.',
            'itemqty.numeric' => 'Item quantity is not a number.',
            'itemunit.required' => 'Unit is required.',
            'itemdescription.required' => 'A description is required.',
            'itemcpu.required' => 'Cost per unit should not be empty.',
            'itemcpu.numeric' => 'Cost per unit is not a number.',
            'itemcpi.required' => 'Cost per item should not be empty.',
            'itemcpi.numeric' => 'Cost per item is not a number.',
            
        ];

        $this->validate($request, $rules, $customMessages);

        $input = $request->all();



        $cpu = str_replace(",","", $input['itemcpu']); 
        $pr = PurchaseRequestModel::find($input['id_rel']);
        $ppmp = $pr->ppmp->ppmpItems->find($input['ppmp_item_id']);
        $estimated_budget = $input['itemqty'] * $cpu;

        if ($estimated_budget > $ppmp->estimated_budget) {
            return redirect()->back()->with('warning', 'The cost per item is higher than your PPMP estimate!');
        }

        $pr_item = $pr->prItems()->create([
            'pr_form_number'    => $input['prid'],  
            'pr_qty'            => $input['itemqty'],   
            'pr_unit'           => $input['itemunit'],
            'pr_description'    => $input['itemdescription'],
            'pr_cost_per_unit'  => $cpu,  
            'pr_estimated_cost' => $estimated_budget, 
        ]);

        $grand_total = $pr->prItems()->get()->sum('pr_estimated_cost');

        if ($pr_item == true) {
            $update_ppmp_item = $ppmp->update([
                'inventory'   => $ppmp->inventory - $pr_item->pr_qty,
                'remaining_budget'   => $ppmp->remaining_budget - $pr_item->pr_estimated_cost,
            ]);

            $pr->ppmp->update([
                'remaining_budget'   => $pr->ppmp->remaining_budget - $grand_total,
            ]);
            //go back
            return redirect()->back()->with('success','Added item to your purchase request.');
        }


        //go back
        return redirect()->back()->with('danger','Item not Added.');

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

        $rules = [
            'prlist' => 'required|string|max:255',
            'qtylist' => 'required',
            'unitlist' => 'required',
            'descriptionlist' => 'required|string|max:255',
            'cpulist' => 'required',
        ];

        $customMessages = [
            'prlist.required' => 'PR Number is missing.',
            'qtylist.required' => 'Item quantity is required.',
            'unitlist.required' => 'Unit is required.',
            'descriptionlist.required' => 'A description is required.',
            'cpulist.required' => 'Cost per unit should not be empty.',
            
            
        ];

        $this->validate($request, $rules, $customMessages);
        
        $cpulist = str_replace(",","",$request->get('cpulist'));
        $update_item = PurchaseRequestItemModel::find($id);
        $update_item->pr_form_number = $request->get('prlist');
        $update_item->pr_qty = $request->get('qtylist');
        $update_item->pr_unit = $request->get('unitlist');
        $update_item->pr_description = $request->get('descriptionlist');
        $update_item->pr_cost_per_unit = $cpulist;
        $update_item->pr_estimated_cost = $request->get('qtylist')*$cpulist;

        $update_item->save();



        //go back
        return redirect()->back()->with('success','Updated item details!');     

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
        $delete_item = PurchaseRequestItemModel::findorFail($id);
        $delete_item->delete();
        return redirect()->back()->with('flash_message','Item Deleted!');

    }

    public function viewpdf($form_no){
        $pr = PurchaseRequestModel::where('pr_form_no',$form_no)->firstorFail();
        $list =PurchaseRequestItemModel::all()->where('pr_form_number', $form_no)->values();
        $dept = Office::where('iso_code',$pr->department)->first();
        $section = Office::where('iso_code',$pr->section)->first();
        $count = $list->count();
        
        $grand_total = $list->sum('pr_estimated_cost');
        $dt   = Carbon::parse($pr->created_at);

        $user = User::where('id',$pr->created_by)->first();

        $aa = Assignatory::where('kind','AA')->where('status',1)->first();
        $c = Assignatory::where('kind','C')->where('status',1)->first();
        $approval = Assignatory::where('kind','A')->where('status',1)->first();

        $created_code = $user->department."/".$user->name."/".$dt->Format('F j, Y')."/".$dt->format("g:i:s A")."/"."BAC"."/".$form_no;

        $results = $list->chunk(15);
        // Total order on each date?
        $sub_total = $results->map(function ($item) {
                return $item->sum(function ($item) {
                    return ($item['pr_estimated_cost']);
                });
            })
        ->toArray();


        $pdf = PDF::loadView('pr.pr-print',compact('pr','results','count','dept','section','grand_total','dt','created_code','aa','c','approval','sub_total')) ->setOption("footer-left",$created_code);

        return $pdf->stream($form_no.'.pdf');
    }

}