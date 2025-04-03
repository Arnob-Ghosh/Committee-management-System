<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoharSubComitee extends Model
{
    use HasFactory;
    protected $table = 'dohar_sub_comitees';
    protected $fillable = [
        'name',
        'mobile_no',
        'nid',
        'designation',
        'bank_name',
        'comitte_desiignation',
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
