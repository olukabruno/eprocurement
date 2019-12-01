<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class purchaseOrder extends Model
{
    protected $table = 'purchase_order';

    protected $fillable = [
    	'id',
    	'pr_number',
    	'supplier',
    	'supplier_address',
    	'tin',
    	'mode_of_procurement',
    	'place_of_delivery',
    	'date_of_delivery',
    	'delivery_term',
    	'payment_term',	
        'office',
        'requestor' 
	];
}
