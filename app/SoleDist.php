<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SoleDist extends Model
{
    //
    protected $table = 'soledist';

    protected $fillable = [
    	'id',
    	'name',
    	'address',
    	'file_name',
	];
}
