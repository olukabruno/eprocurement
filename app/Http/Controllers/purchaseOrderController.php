<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AbstractModel;
use App\Assignatory;
use App\PurchaseRequestModel;
use App\PurchaseRequestItemModel;
use App\DataTables\purchaseOrderDataTable;
use App\DataTables\closedprPurchaseOrderDataTable;
use App\abstractitemmodel;
use App\abstractsupplier;
use App\abstractprice;
use App\Office;
use App\purchaseOrder;
use App\User;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;
use PDF;
use NumberFormatter;

class purchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(purchaseOrderDataTable $dt1, closedprPurchaseOrderDataTable $dt2)
    {

        if (request()->get('table') == 'purchase_request') {
            return $dt2->render('po.poView', compact('dt1', 'dt2'));
        }
        return $dt1->render('po.poView', compact('dt1', 'dt2'));
    }

    /**
     * Display the specified data.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getData($form_no)
    {
        $pr = PurchaseRequestModel::where('pr_form_no', $form_no)->firstorFail();
        if ($pr->supplier_type == "Government Agency") {
            # code...
             $supplier = $pr->supplier_name;
             $supplier_address = $pr->supplier_address;
        }else{
            $abstract = AbstractModel::where('pr_number',$form_no)->first();
            $supplier_query = abstractsupplier::where('abstract_id','=',$abstract->id)
            ->where('selected','=',1)->first();
            $supplier = $supplier_query->supplier;
            $supplier_address = $supplier_query->supplier_address;
        }
        

        
        return response()->json(["supplier" => $supplier, "supplier_address" => $supplier_address]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $rules = [

            'mode' => 'required',
            'supplier' => 'required|string|max:180',
            'delivery_place' => 'required',
        ];

        $customMessages = [

            'mode.required' => 'Please indicate the mode of procurement.',
            'supplier.required' => "Supplier's Details is required.",
            'delivery_place.required' => 'Delivery Place is required.',


        ];

        $this->validate($request, $rules, $customMessages);

        $pr = PurchaseRequestModel::find($id);
        $abstract = AbstractModel::where('pr_number',$pr->pr_form_no)->first();
        $pr->created_po = '1';
        $po = new purchaseOrder;
        $po->pr_number = $pr->pr_form_no;
        $po->supplier = $request->get('supplier');
        $po->supplier_address = $request->get('supplier_address');
        $po->tin = $request->get('tin');
        $po->mode_of_procurement = $request->get('mode');
        $po->place_of_delivery = $request->get('delivery_place');
        $po->date_of_delivery = $request->get('delivery_date');
        $po->delivery_term = $request->get('delivery_term');
        $po->payment_term = $request->get('payment_term');
        $po->office = Auth::user()->department;
        $po->requestor = $pr->requestor_name;
        $po->save();

        if ($po->save() === true) {
            $pr->save();
            return redirect()->back()->with('flash_message','Successfully Generated Purchase Order!');
        }else{
            return redirect()->back()->with('errors','Error!');
        }

    }




     /**
     * Stream the PDF form of the Purchase order.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print($form_no)
    {   
        $pr = PurchaseRequestModel::where('pr_form_no', $form_no)->firstorFail();

        if ($pr->supplier_type == "Government Agency") {
            $purchase_order = purchaseOrder::where('pr_number',$form_no)->first();
            $query = $pr->prItems()->get()->values()->chunk(15);
            $grand_total = 0;

        }else{
            $purchase_order = purchaseOrder::where('pr_number',$form_no)->first();
            $query = DB::table('abstract_supplier')
                    ->join('abstract', 'abstract.id', '=', 'abstract_supplier.abstract_id')
                    ->join('abstract_price', 'abstract_price.supplier_id', '=', 'abstract_supplier.id')
                    ->join('abstract_items', 'abstract_items.id', '=', 'abstract_price.item_id')
                    ->select(
                        'abstract_items.particulars',
                        'abstract_items.qty',
                        'abstract_items.unit',
                        'abstract_supplier.id',
                        'abstract_supplier.supplier',
                        'abstract_supplier.supplier_address',
                        'abstract_price.unit_price',
                        'abstract_price.total_price'
                    )
                ->where('abstract_supplier.selected','=','1')
                ->get()->values()->chunk(15);

            $grand_total = DB::table('abstract_supplier')
                ->join('abstract', 'abstract.id', '=', 'abstract_supplier.abstract_id')
                ->join('abstract_price', 'abstract_price.supplier_id', '=', 'abstract_supplier.id')
                ->join('abstract_items', 'abstract_items.id', '=', 'abstract_price.item_id')
                ->select(
                    'abstract_items.particulars',
                    'abstract_items.qty',
                    'abstract_items.unit',
                    'abstract_supplier.id',
                    'abstract_supplier.supplier',
                    'abstract_supplier.supplier_address',
                    'abstract_price.unit_price',
                    'abstract_price.total_price'
                )
                ->where('abstract_supplier.selected','=','1')
                ->sum('total_price');
        }
        


        $dt   = Carbon::parse($purchase_order->created_at);

        $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);

        $created_code = Auth::User()->department."/".Auth::User()->wholename."/".$dt->Format('F j, Y')."/".$dt->format("g:i:s A")."/"."BAC"."/".$form_no;

        $approval = Assignatory::where('kind','A')->where('status',1)->first();

        $pdf = PDF::loadView('po.poPrint',compact('query','dt','purchase_order','approval','grand_total','f', 'pr'))
        ->setOption("footer-left",$created_code);

        return $pdf->stream($form_no.'.pdf');    
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
        $po_cancel = purchaseOrder::find($id);
        $po_cancel->delete();

            $pr_reset = PurchaseRequestModel::
            where('pr_form_no', $po_cancel->pr_number)
            ->update(['created_po' => 0]);

        return redirect()->back()->with('flash_message','Purchase Order Cancelled.');
    }
}
