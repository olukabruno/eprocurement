<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    //
    protected $table = 'office';

    protected $fillable = [
    	'id',
    	'iso_code',
    	'office_name',
	];

	public function users()
    {
        return $this->hasMany('App\User');
    }
}


