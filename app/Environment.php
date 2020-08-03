<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Environment extends Model
{
    protected $connection = 'mysql';

    public function spots()
    {
        return $this->hasMany(Spot::class);
    }

    public function support()
    {
        return $this->hasMany(Support::class);
    }
}
