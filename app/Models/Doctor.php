<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
    'user_id',
    'department_id',
    'qualification',
    'experience',
    'bio',
    'photo',
    'status',
    'sunday',
    'monday',
    'tuesday',
    'wednesday',
    'thursday',
    'friday',
    'saturday',
    'fee',
    'specialist'
];


    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
