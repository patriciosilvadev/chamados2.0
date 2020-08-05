<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'admin.departments';

    protected $fillable = ['name', 'email', 'status'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     *
     */
    public function sectors()
    {
        return $this->morphMany(Sector::class, 'support_area');
    }

    /**
     *
     */
    public function supports()
    {
        return $this->morphMany(Support::class, 'area');
    }

    /**
     *
     */
    public function supportAreas()
    {
        return $this->whereHas('sectors')->get();
    }
}
