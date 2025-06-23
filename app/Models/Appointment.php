<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'doctor_id',
        'date',
        'message',
        'time',
        'fee',
        'gender',
        'age',
        'address',
        'pincode',
        'city',
        'state',
        'ispaid',
        'status',
    ];


    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }


}
