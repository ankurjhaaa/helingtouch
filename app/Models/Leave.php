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
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
