<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subdepartment extends Model
{
    protected $table = 'admin.subdepartments';

    protected $fillable = ['department_id','name','email','status'];

    /**
     *
     */
    public function department()
    {
        return $this->belongsTo(Department::class)->with(['subdepartments']);
    }

    /**
     *
     */
    public function users()
    {
        return $this->hasMany(User::class);
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
    public function sectors()
    {
        return $this->morphMany(Sector::class, 'support_area');
    }

    /**
     *
     */
    public function supportAreas(array $filter)
    {
        return $this->whereHas('sectors')
            ->where('department_id', $filter['department'])
            ->get();
    }
}
