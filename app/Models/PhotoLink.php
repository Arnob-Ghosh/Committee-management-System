<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'date',
        'photo_link',
    ];
}
