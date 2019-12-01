<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class abstractprice extends Model
{
    //
    protected $table = 'abstract_price';

    protected $fillable = [
    	'abstract_id',
    	'supplier_id',
    	'item_id',
    	'unit_price',
    	'total_price',
    	
    ];

}
