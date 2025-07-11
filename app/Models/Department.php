<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name',
        'description',
        'status'
    ];

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }



    public function department()
    {
        return $this->belongsTo(Department::class);
    }

}

