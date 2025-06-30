<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{ 
    protected $fillable = [
        'amount', //
        'email', //
        'status', //
        'paymenttype', //
        'paymentid', // 
        'paymentmode', //
        'description',
    ];
}
 