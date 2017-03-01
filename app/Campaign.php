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

    public function getReleaseDateAttribute($value)
    {   
        return \Carbon\Carbon::parse($value)->format('j M Y');
    }

    public function artist()
    {
        return $this->belongsTo('App\Artist');
    }

    public function fans()
    {
        return $this->belongsToMany('App\Fan');
    }

    /*public function fansCount()
    {
        return $this->belongsToMany('App\Fan')
            ->selectRaw('count(fans.id) as followers')
            ->groupBy('pivot_campaign_id');
    }

    public function getFansCountAttribute()
    {
        if ( ! array_key_exists('fansCount', $this->relations)) $this->load('fansCount');

        $related = $this->getRelation('fansCount')->first();

        return ($related) ? $related->followers : 0;
    }*/
}
