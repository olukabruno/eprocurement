<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequestModel extends Model
{
    //
    protected $table = 'purchase_request';

     protected $fillable = [
    	'id',
        'pr_unique',
    	'pr_form_no',
    	'department',
    	'section',
    	'purpose',
    	'requestor_name',
    	'requestor_position',
    	'budget_alloc',
    	'supplier_type',
    	'supplier_name',
    	'status',
    	'created_by',
        'ppmp_id',	
	];

    public function ppmp()
    {
        return $this->belongsTo(Ppmp::class);
    }

    public function prItems()
    {
        return $this->hasMany(PurchaseRequestItemModel::class, 'pr_id');
    }
    public function prSupplement()
    {
        return $this->has('App\SupplementalPurchaseRequestModel');
    }
    
}
