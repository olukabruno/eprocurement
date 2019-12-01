<?php

namespace App\DataTables;

use Yajra\DataTables\Services\DataTable;
use App\Ppmp;
use App\User;
use Carbon\Carbon;
use Auth;

class PpmpDataTable extends DataTable
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
        ->addColumn('action', function ($ppmp) {

            $edit = '<a href="' . route("ppmp.edit", $ppmp->id) . '" class="btn btn-warning btn-xs glyphicon glyphicon-th-list"></a>';

            $delete = ' <a href="' . route("ppmp.delete", $ppmp->id) . '" class="btn btn-danger btn-xs glyphicon glyphicon-remove"></a>';

            $activate = ' <a href="' . route("ppmp.activate", $ppmp->id) . '" title="Activate PPMP" class="btn btn-info btn-xs glyphicon glyphicon-unchecked"></a>';

            $deactivate = ' <a href="' . route("ppmp.deactivate", $ppmp->id) . '" title="Deactivate PPMP" class="btn btn-success btn-xs glyphicon glyphicon-check"></a>';


            if($ppmp->is_activated == 1){
                return $edit." ".$deactivate." ".$delete;    
            }
            return $edit." ".$activate." ".$delete;
            

            

          
        })
        ->editColumn('created_at', function($ppmp) {
                return Carbon::parse($ppmp->created_at)->format('m-d-y');
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Ppmp $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Ppmp $model)
    {

        if (Auth::user()->role == 1) {
            # If usertype is Administrator
            return $model->newQuery()->get();

        }elseif(Auth::user()->department == 'ICT' && Auth::user()->role == 0){
            #If usertype is not Admin but from ICT
            $queries = $model->where('department', 'ICT')->get(); 
            return $queries;

        }
        
        #else
        $queries = $model->where('department', Auth::user()->department)->get(); 
        return $queries;

       

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
            'name' => 'ppmp_year',
            'data' => 'ppmp_year',
            'title' => 'Year',
            ],
            [
            'name' => 'department',
            'data' => 'department',
            'title' => 'Department',
            ],
            [
            'name' => 'created_at',
            'data' => 'created_at',
            'title' => 'Date Created',
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
        return 'Ppmp_' . date('YmdHis');
    }
}
