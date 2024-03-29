<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * Get the attempts for the user.
     */
    public function attempts()
    {
        return $this->hasMany('App\Attempt');
    }

    /**
     * Get the climbs set by a user
     */
    public function settings()
    {
        return $this->hasMany('App\Climb', 'setter_id');
    }

    public function companies()
    {
        return $this->belongsToMany('App\Company', 'users_companies');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
