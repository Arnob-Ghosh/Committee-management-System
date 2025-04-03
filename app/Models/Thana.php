<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thana extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'district_id',
        'status'
    ];

    public function district () {
        return $this->belongsTo(District::class, 'district_id');
    }
}
