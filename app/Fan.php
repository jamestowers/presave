<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fan extends Model
{
    protected $guarded = [
        'id'
    ];

    protected $hidden = [
        'refresh_token',
        'created_at',
        'updated_at'
    ];

    public function campaigns()
    {
        return $this->belongsToMany('App\Campaign');
    }

    public function artists()
    {
        return $this->belongsToMany('App\Artist');
    }
}
