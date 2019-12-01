<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'name', 'email', 'username', 'password', 'wholename', 'contact', 'department', 'role', 'isBACSec',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function offices()
    {
        return $this->belongsTo('App\Office');
    }

    public function signatories()
    {
        return $this->hasMany('App\Assignatory');
    }

    public function ppmp()
    {
        return $this->hasMany(Ppmp::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role');
    }
}
