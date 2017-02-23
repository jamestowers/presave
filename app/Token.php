<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $guarded = [
        'id'
    ];

    protected $hidden = [
        'refresh_token'
    ];
}
