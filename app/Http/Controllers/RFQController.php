<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PurchaseRequestModel;
use App\PurchaseRequestItemModel;
use App\SupplementalPurchaseRequestModel;
use App\UnitsModel;
use App\User;
use Illuminate\Support\Facades\DB;
use Auth;
use App\rfqmodel;
use Carbon\Carbon;
use App\DataTables\rfqclosedprDataTable;
use App\DataTables\rfqmodelDataTable;
use PDF;

class RFQController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(rfqclosedprDataTable $dt1, rfqmodelDataTable $dt2)
    {
        //
        if (request()->get('table') == 'purchase_request') {
            return $dt1->render('rfq.rfq', compact('dt1', 'dt2'));
        }
        return $dt2->render('rfq.rfq', compact('dt1', 'dt2'));
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $add_rfq = PurchaseRequestModel::find($id);
        $add_rfq->created_rfq = 1;

        $generate = new rfqmodel;
        $generate->pr_number = $add_rfq->pr_form_no;
        $generate->created_by = Auth::user()->id;
        $generate->department = Auth::user()->department;
        $generate->purpose = $add_rfq->purpose;
        $generate->status = 1;

        $generate->save();

        $add_rfq->save();

        activity('Generate RFQ Form')->log('Generated RFQ Form with PR#: '.$generate->pr_number);
        return redirect()->back()->with('flash_message','RFQ Form Generated');

    }

     public function print($form_no){

        activity('Stream RFQ Form')->log('Stream generated RFQ file with PR#: '.$form_no);

        $pr = PurchaseRequestModel::where('pr_form_no',$form_no)->where(function ($query) {
                $query->where('supplier_type','Canvass')
                      ->orWhere('supplier_type','Sole Distributor');
                })->first();
        $pr_item = PurchaseRequestItemModel::all()->where('pr_form_number',$form_no);
        $results = $pr_item->chunk(15);
        $user = DB::table('users')->where('id',$pr->created_by)->first();

        $title   = 'RFQ-'.$pr->pr_unique;

        $dt   = Carbon::parse($pr->created_at);
        $dt_rfq = $dt->format('F j, Y');
        $created_code = $user->department."/".$user->name."/".$dt->Format('F j, Y')."/".$dt->format("g:i:s A")."/"."BAC"."/".$form_no;

        $pdf = PDF::loadView('rfq.rfq-print',compact('pr','results','title','dt_rfq'))
            ->setOption("footer-left",$created_code);

        return $pdf->stream($title.'.pdf');
    }

    public function cancel_rfq($id){
        
        $rfq_delete = rfqmodel::find($id);
        $pr_reset = DB::table('purchase_request')
            ->where('pr_form_no', $rfq_delete->pr_number)
            ->update(['created_rfq' => 0]);
        $rfq_delete->delete(); 
        activity('Cancel RFQ Form')->log('Administrator Reset of RFQ with PR#: '.$rfq_delete->pr_number);
        return redirect()->back()->with('flash_message','Request for Quotation Form Cancelled');
    }
    
}
