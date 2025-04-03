<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsTicker extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'speech_role',
        'short_desc',
        'long_desc',
        'headline',
        'status'
    ];
}
