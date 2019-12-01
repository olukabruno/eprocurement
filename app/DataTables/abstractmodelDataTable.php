<?php

namespace App\DataTables;

use App\abstractmodel;
use Yajra\DataTables\Services\DataTable;
use Carbon\Carbon;
use Auth;
use App\User;

class abstractmodelDataTable extends DataTable
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
            ->addColumn('action', function ($abs2) {
            $edit = '<a href="' . route("abstract.show", $abs2->id) . '" title="Add Supplier" class="btn btn-warning btn-xs glyphicon glyphicon-th-list"></a>';
             // $print = '<a href="#" title="Print Abstract" class="btn btn-info btn-xs glyphicon glyphicon-print"></a>';
             $cancel = '<a href="' . route("abstract.cancel", $abs2->id) . '" title="Cancel Abstract" class="btn btn-danger btn-xs glyphicon glyphicon-remove"></a>';
           
                
                if (Auth::user()->role == 1) {
                     # code...
                    return $edit." ".$cancel;
                }else{
                    return $edit;
                } 
            })
            ->editColumn('id', function(abstractmodel $abstract) {
                return sprintf('%03d',$abstract->id); 
            })
            ->editColumn('created_at', function(abstractmodel $abstract) {
                return Carbon::parse($abstract->created_at)->format('m-d-y'); 
            })
            ->editColumn('created_by', function(abstractmodel $abstract) {
                $query = User::where('id','=',$abstract->created_by)->first();
                return $query->wholename; });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\abstractmodel $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(abstractmodel $model)
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
            'title' => 'Abstract ID',
            ],
            [
            'name' => 'pr_number',
            'data' => 'pr_number',
            'title' => 'Purchase Request #',
            ],
            [
            'name' => 'created_by',
            'data' => 'created_by',
            'title' => 'Created By',
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
        return 'abstractmodel_' . date('YmdHis');
    }
}
