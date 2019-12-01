<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PpmpItem extends Model
{
    protected $table = 'ppmp_items';

    protected $fillable = [
    	'code',
    	'description',
    	'qty',
        'unit',
        'estimated_budget',
    	'procurement_mode',
    	'schedule',
        'inventory',
        'remaining_budget',
    	'ppmp_id'
    ];

	protected $guarded = ['id'];

    public function ppmp()
    {
    	return $this->belongsTo(Ppmp::class);
    }

    
}
