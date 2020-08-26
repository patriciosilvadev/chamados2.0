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
    public function subdepartments()
    {
        return $this->hasMany(Subdepartment::class);
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
        return $this->whereHas('sectors')
            ->orWhereHas('subdepartments', function ($query) {
                $query->whereHas('sectors');
            })
            ->get();
    }

    /**
     *
     */
    public function search(array $filters)
    {
        return $this->whereNotNull('status')->with('subdepartments')->get();
    }
}
