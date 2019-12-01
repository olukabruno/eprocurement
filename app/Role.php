<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'slug'];

    public static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            $model->slug = Str::slug($model->name);
            return true;
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function administrator()
    {
        return $this->role == 1;
    }

    public function supervisor()
    {
        return $this->role == 2;
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
