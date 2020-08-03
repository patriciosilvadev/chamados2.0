<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $connection = 'mysql2';

    public function getMenus()
    {
        return $this->whereNotNull('status')->orderBy('name')->get();
    }
}
