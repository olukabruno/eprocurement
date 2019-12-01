<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AbstractModel extends Model
{
    //
    protected $table = 'abstract';

    protected $fillable = [
    	'id',
    	'created_at',
    	'created_by' ,
    	'abstract_no',
    	'pr_number',
    	'proc_details',
    	'office',
    	'requestor_name'
    ];

    
}
