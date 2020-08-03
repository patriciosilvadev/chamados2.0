<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $connection = 'mysql2';

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
