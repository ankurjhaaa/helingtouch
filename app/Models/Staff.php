<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = [
        'name', 'position', 'gender', 'phone', 'joining_date','fee'
    ];
}
