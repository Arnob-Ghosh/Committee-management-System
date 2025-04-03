<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Union extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'district_id',
        'thana_id',
        'status'
    ];

    public function district () {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function thana () {
        return $this->belongsTo(Thana::class, 'thana_id');
    }
}
