<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Justification extends Model
{
    protected $connection = 'mysql';

    protected $fillable = [
        'support_id', 'user_id', 'description'
    ];

    public function support()
    {
        return $this->belongsTo(Support::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->with(['department', 'subdepartment']);
    }
}
