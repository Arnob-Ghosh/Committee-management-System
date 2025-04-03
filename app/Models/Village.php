<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'thana_id',
        'union_id',
        'status'
    ];

    public function thana () {
        return $this->belongsTo(Thana::class, 'thana_id');
    }

    public function union () {
        return $this->belongsTo(Union::class, 'union_id');
    }
}
