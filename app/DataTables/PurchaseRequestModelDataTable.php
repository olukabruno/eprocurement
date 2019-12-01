<?php

namespace App\DataTables;

use App\PurchaseRequestItemModel;
use App\PurchaseRequestModel;
use Yajra\DataTables\Services\DataTable;
use Auth;
use Carbon\Carbon;
use App\Ppmp;

class PurchaseRequestModelDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)->addColumn('action', function ($pr) {
            $items = '<a href="' . route("pr.items", $pr->id) . '" id="items" class="btn btn-primary btn-xs" title="Items"><span class="glyphicon glyphicon-th-list"></span></a>';//item button

            $items2 = '';//item button

            $edit_form = '<a href="' . route("pr.edit", $pr->id) . '" id="edit_form" id="edit_form" class="btn btn-warning btn-xs" title="Edit Form"><span class="glyphicon glyphicon-edit"></span></a>';
            //edit button

            $cancel_pr = '<a href="' . route("pr.delete", $pr->id) . '" id="cancel_pr" class="btn btn-danger btn-xs" title="Cancel Form"><span class="glyphicon glyphicon-remove"></span></a>'; //cancel button

            $close_pr = '';

            //
            //close/approve button
            $reset_pr = '';
            //close/approve button

            $auth = Auth::user();
        
            $status = $pr->status;

            switch ($status) {
                case 'Closed':
                    if ($auth->role == 1) {
                        //reset function for Administrator
                        return $items.' '.$cancel_pr.' '.$reset_pr;
                    } else {
                        return $items.' '.$cancel_pr;
                    }
                    break;

                case 'Pending':
                $count = PurchaseRequestItemModel::where('pr_form_number', $pr->pr_form_no)->count();
                    if ($auth->isBACSec == 1) {
                        // If usertype is BAC Secretariat
                        if ($count == 0) {
                            //Check if there are items in the Purchase Request
                            if ($auth->department <> $pr->department) {
                                //Check if the BAC Secretariat is dealing with other departments
                                return $cancel_pr;
                            } else {
                                return $items2.' '.$edit_form.' '.$cancel_pr;
                            }
                        } else {
                            if ($auth->department <> $pr->department) {
                                return $items2.' '.$cancel_pr.' '.$close_pr;
                            } else {
                                return $items2.' '.$edit_form.' '.$cancel_pr.' '.$close_pr;
                            }
                        }
                    } elseif ($auth->role == 1) {
                        // If usertype is an Administrator
                        if ($count == 0) {
                            return $items.' '.$edit_form.' '.$cancel_pr;
                        } else {
                            return $items.' '.$edit_form.' '.$cancel_pr.' '.$close_pr;
                        }
                    } else {
                        //If usertype is End User or Department
                        return $items.' '.$edit_form.' '.$cancel_pr;
                    }
                    break;

                default:
                    // show nothing
                    if ($auth->role == 1) {
                        # code...
                        return $reset_pr;
                    }
                    break;
            }
        })
        ->editColumn('created_at', function (PurchaseRequestModel $pr) {
            return Carbon::parse($pr->created_at)->format('m-d-y');
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\PurchaseRequestModel $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(PurchaseRequestModel $model)
    {
        $verify = Auth::user();
        $queries = $model->newQuery()->where('is_supplemental', '=', 0)->where('status', 'Pending')->whereYear('created_at', date('Y'));


        if ($verify->isBACSec == 1 || $verify->role == 1) {
            # If usertype is BAC Secretariat or an Administrator
            return $queries->get();
        } elseif ($verify->department == 'ICT' && $verify->role == 0) {
            #If usertype is not Admin but from ICT
            return $queries->where('section', 'ICT')->get();
        } else {
            #If usertype is Department
            return $queries->where('department', $verify->department)->whereNull('section')->get();
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
            'title' => 'PR Form Number',
            ],
            [
            'name' => 'purpose',
            'data' => 'purpose',
            'title' => 'Purpose',
            ],
            [
            'name' => 'status',
            'data' => 'status',
            'title' => 'Status',
            ],
            [
            'name' => 'created_at',
            'data' => 'created_at',
            'title' => 'Date',
            ],
        ];
    }

    protected function getBuilderParameters()
    {
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
        return 'PurchaseRequestModel_' . date('YmdHis');
    }
}
