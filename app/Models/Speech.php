<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speech extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'role',
        'long_desc',
        'title',
        'status'
    ];
}
