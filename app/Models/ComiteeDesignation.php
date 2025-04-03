<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComiteeDesignation extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'mobile_no',
        'nid',
        'designation',
        'bank_name',
        'comitee_designation'
    ];
}
