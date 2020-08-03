<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spot extends Model
{
    public function environment()
    {
        return $this->belongsTo(Environment::class);
    }

    public function supports()
    {
        return $this->hasMany(Support::class);
    }
}
