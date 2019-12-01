<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rfqmodel extends Model
{
    //
    protected $table = 'rfq';

    protected $fillable = [
    	'id',
    	'pr_number',
    	'department',
    	'status',
    	'created_by',
	];
}
