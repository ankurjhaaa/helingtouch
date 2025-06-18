<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'visiting_hours',
        'emergency_available'
    ];
}
