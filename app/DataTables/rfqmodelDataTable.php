<?php

namespace App\DataTables;

use App\rfqmodel;
use Yajra\DataTables\Services\DataTable;
use Carbon\Carbon;
use Auth;

class rfqmodelDataTable extends DataTable
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
            ->addColumn('action', function ($rfq2) {
            $print_btn  = '<a href="' . route("rfq.print", $rfq2->pr_number) . '" title="Print RFQ" class="btn btn-primary btn-xs glyphicon glyphicon-print" target="_blank"></a>';
            $cancel_btn = '<a href="' . route("rfq.reset", $rfq2->id) . '" title="Cancel RFQ" class="btn btn-danger btn-xs glyphicon glyphicon-remove"></a>';

                if (Auth::user()->role == 1) {
                    # code...
                    return $print_btn." ".$cancel_btn;
                }else{
                    return $print_btn;
                }
            })
            ->editColumn('created_at', function(rfqmodel $rfq) {
                return Carbon::parse($rfq->created_at)->format('m-d-y');
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\rfqmodel $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(rfqmodel $model)
    {
        if (Auth::user()->role == 1) {
            return $model->newQuery()->get();
        }else{
            return $model->newQuery()->where('department',Auth::user()->department)->get();
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
            'name' => 'pr_number',
            'data' => 'pr_number',
            'title' => 'PR Form Number',
            ],
            [
            'name' => 'purpose',
            'data' => 'purpose',
            'title' => 'Purpose',
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
        return 'rfqmodel_' . date('YmdHis');
    }
}
