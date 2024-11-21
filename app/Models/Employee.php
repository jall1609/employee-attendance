<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $guarded  = ['id'];

    public function getRouteKeyName()
    {
        return 'username';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
