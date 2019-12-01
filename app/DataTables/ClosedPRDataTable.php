<?php

namespace App\DataTables;

use App\PurchaseRequestModel;
use Yajra\DataTables\Services\DataTable;
use Auth;
use App\User;
use Carbon\Carbon;

class ClosedPRDataTable extends DataTable
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
            ->addColumn('action', function ($supp) {
                return '<a href="' . route("supplemental.generate", $supp->id) . '" title="Generate Supplemental PR" class="btn btn-primary btn-xs glyphicon glyphicon-plus"></a>';
            })
            ->editColumn('created_at', function(PurchaseRequestModel $pr) {
                return Carbon::parse($pr->created_at)->format('m-d-y');
            })
            ->editColumn('created_by', function(PurchaseRequestModel $pr) {
                $query = User::where('id','=',$pr->created_by)->first();
                return $query->wholename;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(PurchaseRequestModel $model)
    {
        $queries = $model->newQuery()->where('is_supplemental','=',0)->where('created_supplemental','=',0)->where('status',"Closed");
        $verify = Auth::user();
        
        if ($verify->role == 1) {
            # If usertype is Administrator
            return $queries->get();
        }elseif($verify->department == 'ICT' && $verify->role == 0){
            #If usertype is not Admin but from ICT
            return $queries->where('section','ICT')->get();
        }else{
            #If usertype is Department
            return $queries->where('department',$verify->department)->whereNull('section')->get();
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
                    ->ajax(['data' => 'function(d) { d.table = "purchase_request"; }'])
                    ->addAction(['width' => '40px'])
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
            'name' => 'pr_form_no',
            'data' => 'pr_form_no',
            'title' => 'PR Form Number',
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
        return 'ClosedPR_' . date('YmdHis');
    }
}
