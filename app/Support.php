<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    protected $table = 'chamados.supports';
    protected $fillable = [
        'user_id','support_area_id','support_area_type',
        'environment_id','spot_id','sector_id','service_id',
        'description','execution_by','attach_file_name',
        'status','desired_date','expected_date','real_date',
        'expected_hours','real_hours','done_by','recurrent',
    ];

    protected $casts = [ 'done_by' => 'array' ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function area()
    {
        return $this->morphTo();
    }

    public function environment()
    {
        return $this->belongsTo(Environment::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function spot()
    {
        return $this->belongsTo(Spot::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function activities()
    {
        return $this->morphMany(Activity::class, 'activity');
    }

    public function justification()
    {
        return $this->hasOne(Jutification::class);
    }

    public function notificationTrigger()
    {
        return $this->messages()
            ->whereBetween('created_at', [Carbon::now()->subMinutes(30), Carbon::now()])
            ->count();
    }

    public function search(array $filters)
    {
        return $this->whereIn('status', $filters['status'] ? json_decode($filters['status']) : [1, 2])
            ->whereBetween(
                'created_at',
                [
                    $filters['start_date'] ? $filters['start_date'] : Carbon::now()->subYear(),
                    $filters['end_date'] ? $filters['end_date'] : Carbon::now(),
                ]
            )
            ->where(function ($query) use ($filters) {
                $role = auth()->user()->role();
                if ($filters['owner'] == 2 && $role == 'manager') {
                    return $query->whereHas('user.department', function ($query) {
                        return $query->where('departments.id', auth()->user()->department->id);
                    });
                }
                if ($filters['owner'] == 0 && $role == 'support') {
                    if (count(auth()->user()->department->subdepartments) > 0) {
                        return $query->where('area_id', auth()->user()->subdepartment->id);
                    }
                    return $query->where('area_id', auth()->user()->department->id);
                }
                if ($filters['owner'] == 1) {
                    return $query->where('user_id', auth()->user()->id);
                }
            })
            ->where(function ($query) use ($filters) {
                $query->where('id', 'like', "%" . $filters['search'] . "%")
                    ->orWhereHas('environment', function ($query) use ($filters) {
                        $query->where('name', 'like', "%" . $filters['search'] . "%");
                    })
                    ->orWhereHas('sector', function ($query) use ($filters) {
                        $query->where('name', 'like', "%" . $filters['search'] . "%");
                    })
                    ->orWhereHas('service', function ($query) use ($filters) {
                        $query->where('name', 'like', "%" . $filters['search'] . "%");
                    })
                    ->orWhereHas('spot', function ($query) use ($filters) {
                        $query->where('name', 'like', "%" . $filters['search'] . "%");
                    })
                    ->orWhereHas('user', function ($query) use ($filters) {
                        $query->where('name', 'like', "%" . $filters['search'] . "%");
                    });
            })
            ->orderBy('status')
            ->with(['user', 'environment', 'service', 'spot', 'sector', 'area'])
            ->paginate($filters['paginate']);
    }
}
