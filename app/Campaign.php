<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $guarded = [
        'id'
    ];

    public function artist()
    {
        return $this->belongsTo('App\Artist');
    }
}
