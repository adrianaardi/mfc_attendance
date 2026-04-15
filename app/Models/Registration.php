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
    ];

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}