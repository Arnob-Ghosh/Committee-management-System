<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CentralComitee extends Model
{
    use HasFactory;
    protected $table = 'central_comitees';

    protected $fillable = [
        'name',
        'mobile_no',
        'nid',
        'designation',
        'bank_name',
        'comitte_designation',
        'form',
        'to_year',
        'duration',
        'comitee',
        'current',
        'member_id',

    ];

    public function bankUser () {
        return $this->hasOne(BankUser::class, 'id', 'member_id');
    }
}
