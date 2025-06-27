<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = [
        'chat', 'useremail','doctorid','image'
    ];

    public function user()
{
    return $this->belongsTo(User::class, 'userid');
}
}
