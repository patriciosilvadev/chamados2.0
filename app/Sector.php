<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    protected $table = 'chamados.sectors';
    protected $fillable = [
        'support_area_id','support_area_type','name','status'
    ];

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function supports()
    {
        return $this->hasMany(Support::class);
    }

    public function support_area()
    {
        return $this->morphTo();
    }
}
