<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AbstractModel;
use App\PurchaseRequestModel;
use App\PurchaseRequestItemModel;
use App\DataTables\inspectionReportDataTable;
use App\DataTables\inspectionReportPRDataTable;
use App\abstractitemmodel;
use App\abstractsupplier;
use App\abstractprice;
use App\purchaseOrder;
use App\Office;
use App\User;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;
use App\inspectionReport;
use PDF;

class inspectionReportController extends Controller
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
    public function index(inspectionReportDataTable $dt1, inspectionReportPRDataTable $dt2)
    {
    	if (request()->get('table') == 'purchase_request') {
            return $dt2->render('inspection.inspectionReportView', compact('dt1', 'dt2'));
        }
        return $dt1->render('inspection.inspectionReportView', compact('dt1', 'dt2'));
    }

    public function create(Request $request,$id){
        $new_ir = new inspectionReport;
        $new_ir->supplier = $request->get('supplier'); 
        $new_ir->po_no = $request->get('po_no');
        $new_ir->pr_number = $request->get('pr_number');
        $new_ir->requisitioning_office = $request->get('requisitioning_office');
        $new_ir->property_officer = $request->get('property_officer');
        $new_ir->inspection_officer = $request->get('inspection_officer');
        $new_ir->invoice_no = $request->get('invoice_no');
        $new_ir->po_date = $request->get('date');
        $new_ir->save();

        $update_pr = PurchaseRequestModel::where('pr_form_no', $new_ir->pr_number)->first();
        $update_pr->created_inspection = 1;
        $update_pr->save();

        activity('Create Inspection Report')
        ->log('Generated Inspection Report: #'.$new_ir->id);
        return redirect()->back()->with('success', 'Acceptance and Inspection Report successfully created!');

    }

    public function getData($form_no)
    {
    	$po = purchaseOrder::where('pr_number',$form_no)->first();
        $date = Carbon::parse($po->created_at)->Format('F j, Y');
        return response()
        ->json(["po_id" => $po->id, "supplier" => $po->supplier, "requisitioning_office" => $po->office, "date" => $date, "pr_number" => $po->pr_number]);
    }

    public function print($form_no)
    {
        $ir = inspectionReport::where('pr_number',$form_no)->first();
        $office = Office::where('iso_code',$ir->requisitioning_office)->first();
        $abstract = AbstractModel::where('pr_number',$form_no)->first();
        $abstract_items = abstractitemmodel::all()->where('abstract_id',$abstract->id)->chunk(35);
        
        $dt   = Carbon::parse($ir->created_at);

        $created_code = Auth::User()->department."/".Auth::User()->wholename."/".$dt->Format('F j, Y')."/".$dt->format("g:i:s A")."/"."BAC"."/".$form_no;

        $options = [
            'margin-top'    => 10,
            'margin-right'  => 15,
            'margin-bottom' => 15,
            'margin-left'   => 15,
        ];

        $pdf = PDF::loadView('inspection.inspectionReportPrint', compact('ir','office','abstract_items'))->setOption('orientation','portrait')->setOption("footer-left",$created_code);

        foreach ($options as $margin => $value) {
            $pdf->setOption($margin, $value);
        }
        activity('Generate IR PDF Form')
        ->log('Generated PDF Inspection Report: #'.$ir->id);
        return $pdf->stream($form_no.'.pdf');

    }

    public function cancel($id)
    {
        $cancel_ir = inspectionReport::find($id);
        $cancel_ir->delete();
        $update_pr = PurchaseRequestModel::where('pr_form_no',$cancel_ir->pr_number)->first();
        $update_pr->created_inspection = 0;
        $update_pr->save();
        activity('Cancel Inspection Report')
        ->log('Cancelled Inspection Report');
        return redirect()->back()->with('info', 'Cancelled Inspection Report');

    }

    public function edit(inspectionReportDataTable $dt1, $id)
    {

        $ir = inspectionReport::findorFail($id);
        return $dt1->render('inspection.iredit', compact('dt1', 'ir'));
    }

    public function update(Request $request,$id)
    {
        $new_ir = inspectionReport::findorFail($id);
        $new_ir->supplier = $request->get('supplier'); 
        $new_ir->po_no = $request->get('po_no');
        $new_ir->pr_number = $request->get('pr_number');
        $new_ir->requisitioning_office = $request->get('requisitioning_office');
        $new_ir->property_officer = $request->get('property_officer');
        $new_ir->inspection_officer = $request->get('inspection_officer');
        $new_ir->invoice_no = $request->get('invoice_no');
        $new_ir->po_date = $request->get('date');
        $new_ir->save();

        activity('Update Inspection Report')
        ->log('Updated Inspection Report: #'.$new_ir->id);
        return redirect()->route('ir.index')->with('success', 'Acceptance and Inspection Report successfully updated!');

    }
}
