<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['company_id', 'address_id'];

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function address()
    {
        return $this->hasOne('App\Address');
    }
}
