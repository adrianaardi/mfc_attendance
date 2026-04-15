<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'registration_id',
        'day',
        'checked_in_at',
    ];

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }
}