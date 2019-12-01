<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequestItemModel extends Model
{
    protected $table = 'pr_items';

    protected $fillable = [
    	'id',
    	'pr_form_number',
    	'pr_qty',
    	'pr_unit',
    	'pr_description',
    	'pr_cost_per_unit',
    	'pr_estimated_cost',
        'pr_id',	
	];

    public function purchaseRequest()
    {
        return $this->belongsTo(PurchaseRequestModel::class, 'pr_id');
    }
}
