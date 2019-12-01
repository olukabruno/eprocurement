<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitsModel extends Model
{
    //
    protected $table = 'units';

    protected $fillable = [
    	'iso_code',
    	'iso_name',
    	'iso_description',
	];
}
