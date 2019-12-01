<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Ppmp extends Model
{
    use SoftDeletes;
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

	protected $table ='ppmps';

	protected $fillable = ['ppmp_year', 'user_id', 'estimated_budget', 'department'];
	protected $guarded = ['id'];

    protected static function boot() 
    {
       parent::boot();

       static::deleting(function($ppmp) {
         foreach ($ppmp->ppmpItems()->get() as $ppmpi) {
            $ppmpi->delete();
         }
       });
    }

    public function purchaseRequests()
    {
        return $this->hasMany(PurchaseRequestModel::class);
    }
	
    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function ppmpItems()
    {
    	return $this->hasMany(PpmpItem::class);
    }
}
