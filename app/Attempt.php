<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attempt extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'climb_id',
    ];

    public function climb()
    {
        return $this->belongsTo('App\Climb'); 
    }

    public function user()
    {
        return $this->belongsTo('App\User'); 
    }
}
