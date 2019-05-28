<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name', 'phone', 'email', 'contact_name'];

    public function locations()
    {
        return $this->hasMany('App\Location');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'users_companies');
    }
}
