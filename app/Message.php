<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $connection = 'mysql';

    protected $fillable = [
        'user_id', 'support_id', 'description'
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
