<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hoscontact extends Model
{
    protected $fillable = [
        'name', 'email', 'message'
    ];
}
