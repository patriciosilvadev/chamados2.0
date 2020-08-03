<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'activity_id',
        'activity_type',
        'description'
    ];

    protected $casts = [
        'description' => 'array'
    ];

    /**
     *
     */
    public function activitable()
    {
        return $this->morphTo();
    }
}
