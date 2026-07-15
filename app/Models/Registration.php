<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'designation',
        'agency',
        'two_days_email_status',
        'two_days_email_error',
    ];

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}