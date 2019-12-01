<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class abstractsupplier extends Model
{
    //
    protected $table = 'abstract_supplier';

    protected $fillable = [
    	'abstract_id',
    	'supplier',
    	'supplier_address',
    	'selected',
        'canvasser_name',
        'canvasser_department',

    ];

}
