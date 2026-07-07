<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $fillable = [
        'day', 'speaker', 'title', 'pdf_path', 'order'
    ];
}