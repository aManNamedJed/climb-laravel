<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['address_1', 'address_2', 'city', 'state', 'postal_code', 'country'];

    public function location()
    {
        return $this->belongsTo('App\Location');
    }
}
