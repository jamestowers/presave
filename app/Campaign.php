<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    use SoftDeletes;

    protected $guarded = [
        'id'
    ];

    protected $with = ['artist'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'release_date',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function artist()
    {
        return $this->belongsTo('App\Artist');
    }
}
