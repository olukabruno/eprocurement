<?php

namespace App\DataTables;

use App\inspectionReport;
use Yajra\DataTables\Services\DataTable;
use Carbon\Carbon;
use Auth;
use App\User;

class inspectionReportDataTable extends DataTable
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
            ->addColumn('action', function ($ir) {
            $edit_btn = '<a href="' . route("ir.edit", $ir->id) . '" title="Edit Inspection Report" class="btn btn-warning btn-xs glyphicon glyphicon-edit"></a>';    
            $print_btn  = '<a href="' . route("ir.print", $ir->pr_number) . '" title="Print Inspection Report" class="btn btn-primary btn-xs glyphicon glyphicon-print" target="_blank"></a>';
            $cancel_btn = '<a href="' . route("ir.cancel", $ir->id) . '" title="Cancel Inspection Report" class="btn btn-danger btn-xs glyphicon glyphicon-remove"></a>';

                if (Auth::user()->role == 1) {
                    # code...
                    return $edit_btn." ".$print_btn." ".$cancel_btn;
                }else{
                    return $edit_btn." ".$print_btn;
                }
            })
            ->editColumn('id', function(inspectionReport $ir) {
                return sprintf('%03d',$ir->id); 
            })
            ->editColumn('created_at', function(inspectionReport $ir) {
                return Carbon::parse($ir->created_at)->format('m-d-y'); 
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\inspectionReport $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(inspectionReport $model)
    {
        if (Auth::user()->role == 1) {
            return $model->newQuery()->get();
        }else{
            return $model->newQuery()->where('requisitioning_office', Auth::user()->department)->get();
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
                    ->addAction(['width' => '80px'])
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
            'title' => 'AIR No.',
            ],
            [
            'name' => 'po_no',
            'data' => 'po_no',
            'title' => 'PO No.',
            ],
            [
            'name' => 'pr_number',
            'data' => 'pr_number',
            'title' => 'Purchase Request #',
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
        return 'inspectionReport_' . date('YmdHis');
    }
}
