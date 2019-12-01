<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignatory extends Model
{
    //
    protected $table = 'assignatory';

    protected $fillable = [
    	'id',
    	'dept',
    	'name',
    	'position',
    	'kind',
    	'status',
	];
}
