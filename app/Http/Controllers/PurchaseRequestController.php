<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Office;
use App\User;
use App\Assignatory;
use App\PurchaseRequestModel;
use App\PurchaseRequestItemModel;
use App\Http\Requests\PurchaseRequestFormRequest;
use DB;
use Carbon\Carbon;
use App\DataTables\PurchaseRequestModelDataTable;
use App\AbstractModel;
use App\abstractitemmodel;
use App\abstractsupplier;
use App\abstractprice;
use App\rfqmodel;
use App\SoleDist;
use App\Ppmp;
use App\PpmpItem;
use App\purchaseOrder;
use App\inspectionReport;

class PurchaseRequestController extends Controller
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

    public function viewAll()
    {
        $prDT = PurchaseRequestModel::where('status', "Pending")->get();
        return view('pr.close', compact('prDT'));
    }

    public function viewArchive()
    {
        $prDT = PurchaseRequestModel::where('department', Auth::user()->department)->where('status', "Closed")->orWhere(function ($query) {
            $query->where('status', "Cancelled");
            // ->where('supplier_type', 'Government Agency');
        })->get();
        return view('pr.archive', compact('prDT'));
    }

    public function index(PurchaseRequestModelDataTable $dataTable)
    {
        //
        $user = Auth::User();

        $dist = SoleDist::all();

        $prcode = sprintf('%02d', $user->id);



        $year = date('Y');
        $count = PurchaseRequestModel::where('pr_form_no', 'like', "PR-".$user->department."-".$year."-".$prcode."-"."____")->count();
        $row = sprintf('%04d', $count);

        $requestor = Assignatory::all()->where('dept', '=', Auth::User()->department)->where('kind', '=', 'R')->where('status', '=', 1)->first();

        $pr_unique = $user->department.Carbon::parse($year)->Format('y').sprintf('%02d', $user->id).sprintf('%02d', $count);

        $ppmp = Ppmp::where('department', $user->department)->where('is_activated', '1')->firstorFail();

        $pr_number = "PR-".$user->department."-".$ppmp->ppmp_year."-".$prcode."-".$row;

        return $dataTable->render('pr.pr-section', compact('pr_number', 'user', 'requestor', 'row', 'pr_unique', 'dist', 'ppmp'));
    }

    public function closePR($id)
    {
        $prequest = PurchaseRequestModel::find($id);
        $prequest->status = "Closed";
        $prequest->save();

        //go back
        activity('Close Purchase Request')->log('Closed PR #'.$prequest->pr_form_no);

        return redirect()->back()->with('success', 'Purchase Request Closed.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PurchaseRequestFormRequest $request)
    {
        $ppmp = Ppmp::where('ppmp_year', date('Y'))->firstorFail();
        $input =  $request->all();

        if ($input['pr_supplier_type'] == 'Government Agency') {
            $ppmp->purchaseRequests()->create([
                'pr_unique' => $input['pr_unique'],
                'created_by' => $input['pr_created_by'],
                'pr_form_no' => $input['pr_number'],
                'department' => $input['pr_department'],
                'section' => $input['pr_section'],
                'purpose' => $input['pr_purpose'],
                'requestor_name' => $input['pr_requestor_name'],
                'requestor_position' => $input['pr_requestor_position'],
                'supplier_type' => $input['pr_supplier_type'],
                'supplier_name' => $input['pr_supplier_name'],
                'budget_alloc' => str_replace(",", "", $input['pr_budget_alloc']),
                'status' => $input['pr_status'],
                'created_rfq' => 1,
                'created_abstract' => 1,
            ]);
        } else {
            $ppmp->purchaseRequests()->create([
                'pr_unique' => $input['pr_unique'],
                'created_by' => $input['pr_created_by'],
                'pr_form_no' => $input['pr_number'],
                'department' => $input['pr_department'],
                'section' => $input['pr_section'],
                'purpose' => $input['pr_purpose'],
                'requestor_name' => $input['pr_requestor_name'],
                'requestor_position' => $input['pr_requestor_position'],
                'supplier_type' => $input['pr_supplier_type'],
                'supplier_name' => $input['pr_supplier_name'],
                'budget_alloc' => str_replace(",", "", $input['pr_budget_alloc']),
                'status' => $input['pr_status'],
            ]);
        }


        activity('Create Purchase Request')
        ->log('Created PR Form '.$request->get('pr_number'));

        return redirect()->back()->with('success', 'Registered PR Form #'.$request->get('pr_number').'.');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseRequestModelDataTable $dataTable, $id)
    {
        //
        $edit_form = PurchaseRequestModel::find($id);
        return $dataTable->render('pr.pr-edit', compact('edit_form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PurchaseRequestFormRequest $request, $id)
    {
        $ppmp = PurchaseRequestModel::findorFail($id);
        $input =  $request->all();

        if ($input['pr_supplier_type'] == 'Government Agency') {
            $ppmp->update([
                'created_by' => $input['pr_created_by'],
                'pr_form_no' => $input['pr_number'],
                'department' => $input['pr_department'],
                'section' => $input['pr_section'],
                'purpose' => $input['pr_purpose'],
                'requestor_name' => $input['pr_requestor_name'],
                'requestor_position' => $input['pr_requestor_position'],
                'supplier_type' => $input['pr_supplier_type'],
                'supplier_name' => $input['pr_supplier_name'],
                'budget_alloc' => str_replace(",", "", $input['pr_budget_alloc']),
                'status' => $input['pr_status'],
                'created_rfq' => 1,
                'created_abstract' => 1,
            ]);
        } else {
            $ppmp->update([
                'created_by' => $input['pr_created_by'],
                'pr_form_no' => $input['pr_number'],
                'department' => $input['pr_department'],
                'section' => $input['pr_section'],
                'purpose' => $input['pr_purpose'],
                'requestor_name' => $input['pr_requestor_name'],
                'requestor_position' => $input['pr_requestor_position'],
                'supplier_type' => $input['pr_supplier_type'],
                'supplier_name' => $input['pr_supplier_name'],
                'budget_alloc' => str_replace(",", "", $input['pr_budget_alloc']),
                'status' => $input['pr_status'],
            ]);
        }



        activity('Update Purchase Request')
        ->log('Updated PR Form '.$request->get('pr_number'));

        return redirect()->route('pr.form')->with('success', 'Updated PR Form #'.$request->get('pr_number').'. add items for form generation');
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
        $pr_delete = PurchaseRequestModel::find($id);

        $pritems = $pr_delete->prItems->all();

        foreach ($pritems as $key => $item) {
            $ppmpItem = PpmpItem::findorFail($item->pr_description);
            $reset_inventory = $item->pr_qty + $ppmpItem->inventory;
            $reset_balance = $item->pr_estimated_cost + $ppmpItem->remaining_budget;
            $ppmpItem->remaining_budget = $reset_balance;
            $ppmpItem->inventory = $reset_inventory;
            $ppmpItem->save();
        }

        $pr_delete->status = "Cancelled";

        DB::table('pr_items')->where('pr_form_number', $pr_delete->pr_form_no)->delete();

        //Cancel the record
        $pr_delete->save();

        //go back
        activity('Cancel Purchase Request')
        ->log('Cancelled PR #'.$pr_delete->pr_form_no);

        return redirect()->back()->with('info', 'Purchase Request Cancelled.');
    }

    public function revertpr($id)
    {
        $pr_revert = PurchaseRequestModel::findorFail($id);

        $pritems = $pr_revert->prItems->all();

        if (count($pritems) != 0) {
            foreach ($pritems as $key => $item) {
                $ppmpItem = PpmpItem::findorFail($item->pr_description);
                $reset_inventory = $item->pr_qty + $ppmpItem->inventory;
                $reset_balance = $item->pr_estimated_cost + $ppmpItem->remaining_budget;
                $ppmpItem->remaining_budget = $reset_balance;
                $ppmpItem->inventory = $reset_inventory;
                $ppmpItem->save();
            }
        }

        $air = inspectionReport::where('pr_number', $pr_revert->pr_form_no)->first();
        if ($air != null) {
            $air->delete();
        }
        $pr_revert->created_inspection = 0;

        $po = purchaseOrder::where('pr_number', $pr_revert->pr_form_no)->first();
        if ($po != null) {
            $po->delete();
        }
        $pr_revert->created_po = 0;



        $abstract = AbstractModel::where('pr_number', $pr_revert->pr_form_no)->first();
        if ($abstract != null) {
            $abstract_items = abstractitemmodel::where('abstract_id', '=', $abstract->id)->delete();
            $abstract_supplier = abstractsupplier::where('abstract_id', '=', $abstract->id)->delete();
            $abstract_prices = abstractprice::where('abstract_id', '=', $abstract->id)->delete();
            $abstract->delete();
        }
        $pr_revert->created_abstract = 0;

        $rfq = rfqmodel::where('pr_number', $pr_revert->pr_form_no)->first();
        if ($rfq != null) {
            $rfq->delete();
        }
        $pr_revert->created_rfq = 0;

        $suffix = $pr_revert->pr_form_no.'-01';
        $pr_supplemental = PurchaseRequestModel::where('pr_form_no', $suffix)->first();
        if ($pr_supplemental != null) {
            $pr_supplemental->delete();
        }
        $pr_revert->created_supplemental = 0;

        $pr_revert->status = "Pending";
        $pr_revert->save();

        activity('Reset Purchase Request')
        ->log('Administrator Master Reset PR #'.$pr_revert->pr_form_no);

        return redirect()->back()->with('info', 'Purchase Request Reset.');
    }
}
