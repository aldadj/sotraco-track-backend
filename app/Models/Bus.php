<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $fillable = [

    'number',

    'line',

    'destination',

    'is_tracking',

    'latitude',

    'longitude',

    'last_update'

];


    public function locations()
    {
        return $this->hasMany(BusLocation::class);
    }


    public function activeTracker()
    {
        return $this->hasOne(ActiveTracker::class);
    }
}