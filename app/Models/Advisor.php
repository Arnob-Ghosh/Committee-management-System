<?php

namespace App\Models;

use App\Models\BankUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advisor extends Model
{
    use HasFactory;
    protected $table = 'advisors';

    protected $fillable = [
        'name',
        'mobile_no',
        'nid',
        'designation',
        'bank_name',
        'form',
        'to_year',
        'duration',
        'current',
        'member_id',
    ];
    public function bankUser () {
        return $this->hasOne(BankUser::class, 'id', 'member_id');
    }
}
