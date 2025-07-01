<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $fillable = [
        'doctor_id',
        'leave_date',
        'reason',
        'status',
    ];
    // app/Models/Appointment.php

    public function doctor()
    {
        return $this->hasOne(\App\Models\Doctor::class, 'user_id', 'doctor_id');
    }

}
