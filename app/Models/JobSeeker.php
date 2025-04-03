<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSeeker extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'name',
        'email',
        'contact',
        'father_name',
        'mother_name',
        'district',
        'thana_id',
        'union_id',
        'village',
        'present_address',
        'permanent_address',
        'education_details',
        'comment',
        'feedback',
        'status',
    ];

    public function thana () {
        return $this->belongsTo(Thana::class, 'thana_id');
    }

    public function union () {
        return $this->belongsTo(Union::class, 'union_id');
    }
}
