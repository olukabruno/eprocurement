<?php

namespace App\DataTables;

use App\purchaseOrder;
use App\abstractmodel;
use Yajra\DataTables\Services\DataTable;
use Carbon\Carbon;
use Auth;
use App\User;

class purchaseOrderDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
             ->addColumn('action', function ($po) {
            $print_btn  = '<a href="' . route("po.print", $po->pr_number) . '" title="Print Purchase Order" class="btn btn-primary btn-xs glyphicon glyphicon-print" target="_blank"></a>';
            $cancel_btn = '<a href="' . route("po.cancel", $po->id) . '" title="Cancel Purchase Order" class="btn btn-danger btn-xs glyphicon glyphicon-remove"></a>';

                if (Auth::user()->role == 1) {
                    # code...
                    return $print_btn." ".$cancel_btn;
                }else{
                    return $print_btn;
                }
            })
            ->editColumn('id', function(purchaseOrder $po) {
                return sprintf('%03d',$po->id); 
            })
            ->editColumn('created_at', function(purchaseOrder $po) {
                return Carbon::parse($po->created_at)->format('m-d-y'); 
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\purchaseOrder $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(purchaseOrder $model)
    {
        if (Auth::user()->role == 1) {
            return $model->newQuery()->get();
        }else{
            return $model->newQuery()->where('office',Auth::user()->department)->get();
        }
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->addAction(['width' => '100px'])
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
            'name' => 'id',
            'data' => 'id',
            'title' => 'PO ID',
            ],
            [
            'name' => 'pr_number',
            'data' => 'pr_number',
            'title' => 'Purchase Request #',
            ],
            [
            'name' => 'requestor',
            'data' => 'requestor',
            'title' => 'Requestor',
            ],
            [
            'name' => 'created_at',
            'data' => 'created_at',
            'title' => 'Date',
            ],
        ];
    }

    protected function getBuilderParameters(){
        return [
            'paging' => true,
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'purchaseOrder_' . date('YmdHis');
    }
}
