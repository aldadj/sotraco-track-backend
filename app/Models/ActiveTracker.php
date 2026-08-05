<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActiveTracker extends Model
{

    protected $fillable = [
        'bus_id',
        'user_id',
        'active',
        'last_update'
    ];


    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

}