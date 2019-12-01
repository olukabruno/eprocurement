<?php

namespace App\DataTables;

use App\UnitsModel;
use Yajra\DataTables\Services\DataTable;

class UnitsModelDataTable extends DataTable
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
        ->addColumn('action', function ($dataid) {
                return view('unitsmodel.action',compact('dataid'));
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\UnitsModel $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(UnitsModel $model)
    {
        return $model->newQuery()->select('id', 'iso_code', 'iso_name','iso_description');
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
            'name' => 'iso_code',
            'data' => 'iso_code',
            'title' => 'ISO Code',
            ],
            [
            'name' => 'iso_name',
            'data' => 'iso_name',
            'title' => 'Unit Name',
            ],
            [
            'name' => 'iso_description',
            'data' => 'iso_description',
            'title' => 'Description',
            ]
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
        return 'UnitsModel_' . date('YmdHis');
    }
}
