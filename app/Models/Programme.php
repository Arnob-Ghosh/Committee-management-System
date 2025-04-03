<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    use HasFactory;

    protected $fillable = [
        'programme_name',
        'start_date',
        'end_date',
        'applicant_name',
        'father_name',
        'unions',
        'email',
        'phone',
        'participants_num',
        'child_age1',
        'child_age2',
    ];
}
