<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class abstractitemmodel extends Model
{
    //
    protected $table='abstract_items';

     protected $fillable = [
    	'id',
    	'abstract_id',
    	'qty' ,
    	'unit',
    	'particulars',
    	'created_at',
    	'updated_at',
    ];
}
