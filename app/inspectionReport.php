<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inspectionReport extends Model
{
    //
    protected $table = 'inspection_report';

    protected $fillable = [
        'id',
    	'supplier',
    	'po_no',
    	'pr_number',
    	'requisitioning_office',
    	'property_officer',
    	'inspection_officer',
    ];
}
