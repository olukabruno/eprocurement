<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PurchaseRequestModel;
use App\PurchaseRequestItemModel;
use App\UnitsModel;
use App\User;
use Illuminate\Support\Facades\DB;
use Auth;
use App\DataTables\SupplementalPurchaseDataTable;
use App\DataTables\ClosedPRDataTable;
use Carbon\Carbon;
use App\Ppmp;
use App\PpmpItems;


class SupplementalPRController extends Controller
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

    public function index(SupplementalPurchaseDataTable $dt1,ClosedPRDataTable $dt2)
    {
        if (request()->get('table') == 'purchase_request') {
            return $dt2->render('pr.pr-supplemental', compact('dt1', 'dt2'));
        }
        return $dt1->render('pr.pr-supplemental', compact('dt1', 'dt2'));
    }

    public function generate($id){

        $create_supp = PurchaseRequestModel::find($id);
        $create_supp->created_supplemental = 1;

        $ppmp_no = $create_supp->ppmp_id; 
        $supp_no = ($create_supp->pr_form_no)."-01";
        $unique = ($create_supp->pr_unique)."S";

        $generate = new PurchaseRequestModel;
        $generate->pr_unique = $unique;
        $generate->pr_form_no = $supp_no;
        $generate->prev_pr = $create_supp->pr_form_no;
        $generate->created_by = Auth::user()->id;
        $generate->department = $create_supp->department;
        $generate->section = $create_supp->section;
        $generate->purpose = $create_supp->purpose;
        $generate->requestor_name = $create_supp->requestor_name;
        $generate->requestor_position = $create_supp->requestor_position;
        $generate->budget_alloc = $create_supp->budget_alloc;
        $generate->supplier_type = $create_supp->supplier_type;
        $generate->supplier_name = $create_supp->supplier_name;
        $generate->supplier_address = $create_supp->supplier_address;
        $generate->status = "Pending";
        $generate->created_supplemental = 0;
        $generate->ppmp_id = $ppmp_no;
        $generate->is_supplemental = 1;

        $generate->save();
        $create_supp->save();

        activity('Create Supplemental PR')
        ->log('Generated Supplemental PR#'.$supp_no);

        return redirect()->back()->with('flash_message','Supplemental PR Form Generated');
    }


    public function items($id){

        $query = PurchaseRequestModel::find($id);

        $prev_pr = $query->prev_pr;

        $pr = PurchaseRequestModel::where('pr_form_no',$prev_pr)->get();

        $list =PurchaseRequestItemModel::all()->where('pr_form_number', $query->pr_form_no);

        $list2 = PurchaseRequestItemModel::all()->where('pr_form_number', $query->prev_pr);



        $count = $list->count() + 1;

        $grand_total = $list->sum('pr_estimated_cost');

        $units = UnitsModel::all();

        return view('pr.pr-items-supplemental',compact('pr','query','list','count','grand_total','units','list2'));

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pr_delete = PurchaseRequestModel::find($id);

        $pr_reset = DB::table('purchase_request')
            ->where('pr_form_no', $pr_delete->prev_pr)
            ->update(['created_supplemental' => 0]);

        // $pr_items = DB::table('pr_items')->where('pr_form_number',$pr_delete->pr_form_no)->delete();

        $pr_delete->delete();

        activity('Delete Supplemental PR')
        ->log('Deleted Supplemental PR#'.$pr_delete->pr_form_no);
        return redirect()->back()->with('flash_message','Supplemental Purchase Request Cancelled.');
    }
}
