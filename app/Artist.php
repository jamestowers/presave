<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    public function campaigns()
    {
        return $this->hasMany('App\Campaign');
    }
}
