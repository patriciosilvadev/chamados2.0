<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $connection = 'mysql';

    protected $fillable = ['sector_id', 'name','status'];

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function supports()
    {
        return $this->hasMany(Support::class);
    }
}
