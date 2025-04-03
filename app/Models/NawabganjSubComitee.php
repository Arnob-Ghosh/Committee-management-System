<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NawabganjSubComitee extends Model
{
    use HasFactory;
   

    public function bankUser () {
        return $this->hasOne(BankUser::class, 'id', 'member_id');
    }
}
