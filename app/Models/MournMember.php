<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MournMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'name',
        'Died Date',
        'status'
    ];

    public function user () {
        return $this->hasOne(BankUser::class, 'id', 'member_id');
    }

    // public function BankUser () {
    //     return $this->belongsTo(BankUser::class, 'member_id');
    // }
}
