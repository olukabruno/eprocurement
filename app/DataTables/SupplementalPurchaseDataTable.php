<?php

namespace App\DataTables;

use App\PurchaseRequestModel;
use App\PurchaseRequestItemModel;
use Yajra\DataTables\Services\DataTable;
use Auth;
use App\User;
use Carbon\Carbon;

class SupplementalPurchaseDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)->addColumn('action', function ($supp) {

        $items = '<a href="' . route("supplemental.items", $supp->id) . '" title="Supplemental PR Items" class="btn btn-primary btn-xs glyphicon glyphicon-th-list"></a>';
        $close_pr = '<a href="' . route("pr.close", $supp->id) . '" id="close_pr" class="btn btn-success btn-xs glyphicon glyphicon glyphicon-ok" title="Close Purchase Request"></a>';
        //close/approve button
        $reset_pr = '<a href="' . route("pr.revert",  $supp->id) . '" id="reset_pr" class="btn btn-info btn-xs glyphicon glyphicon glyphicon-repeat" title="Resert Purchase Request Status"></a>';
        $cancel_pr = '<a href="' . route("pr.delete", $supp->id) . '" id="cancel_pr" class="btn btn-danger btn-xs glyphicon glyphicon-remove" title="Cancel Form"></a>'; //cancel button

        $auth = Auth::user();
        $status = $supp->status;

            switch ($status) {
                case 'Closed':
                    if ($auth->role == 1 && $supp->created_rfq == 0) {
                        //reset function for Administrator
                        return $items.' '.$delete.' '.$reset_pr;
                    }else{
                        return $items.' '.$delete;
                    }
                    break;

                case 'Pending':
                $count = PurchaseRequestItemModel::where('pr_form_number',$supp->pr_form_no)->count(); 
                    if ($auth->isBACSec == 1) {
                    // If usertype is BAC Secretariat
                        if ($count == 0) { 
                        //Check if there are items in the Purchase Request
                            return $items.' '.$cancel_pr;
                        }else{ 
                            return $items.' '.$cancel_pr.' '.$close_pr;   
                        }

                    }elseif ($auth->role == 1) {
                    // If usertype is an Administrator
                        if ($count == 0) {
                            return $items.' '.$cancel_pr;
                        }else{
                            return $items.' '.$cancel_pr.' '.$close_pr;
                        }

                    }else{
                    //If usertype is End User or Department
                        return $items.' '.$cancel_pr;
                    }
                    break;
                
                default:
                    // show nothing
                    if ($auth->role == 1) {
                        # code...
                        return $reset_pr;
                    }
                    elseif($auth->isBACSec == 1){
                        #none
                    }else{
                        return $delete;
                    }
                    break;
            }

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
        $queries =  $model->newQuery()->where('is_supplemental','=',1)->where('created_supplemental','=',0);
        $verify = Auth::user();
        
        if ($verify->role == 1 || $verify->isBACSec == 1) {
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
            'name' => 'pr_form_no',
            'data' => 'pr_form_no',
            'title' => 'Supplemental PR Number',
            ],
            [
            'name' => 'prev_pr',
            'data' => 'prev_pr',
            'title' => 'Previous PR Number',
            ],
            [
            'name' => 'status',
            'data' => 'status',
            'title' => 'Status',
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
        return 'SupplementalPurchase_' . date('YmdHis');
    }
}
