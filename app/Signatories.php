<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Signatories extends Model
{
    //
    protected $table = 'signatories';

    protected $fillable = [
    	'id',
    	'dept',
    	'name',
    	'position',
    	'kind',
    	'status',
	];
}
