<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpensiveAmount extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'mode',
        'cash_in',
        'cash_out',
        'remark',
        'entry_by',
    ];

    // Total Cash in Amount
    public static function totalCashInAmount(){
        $cashes = ExpensiveAmount::all();

        $totalAmount = 0;
        foreach ($cashes as $cash) {
            # code...
            $totalAmount += $cash->cash_in;
        }
        return $totalAmount;
    }

    // Total Cash in Amount
    public static function totalCashOutAmount(){
        $cashes = ExpensiveAmount::all();

        $totalAmount = 0;
        foreach ($cashes as $cash) {
            # code...
            $totalAmount += $cash->cash_out;
        }
        return $totalAmount;
    }

    // Total Balance Amount
    public static function totalBalanceAmount(){
        $cashes = ExpensiveAmount::all();

        $cashInAmount = 0;
        $cashOutAmount = 0;
        foreach ($cashes as $cash) {
            # code...
            $cashInAmount += $cash->cash_in;
        }

        foreach ($cashes as $cash) {
            # code...
            $cashOutAmount += $cash->cash_out;
        }

        $totalAmount = $cashInAmount - $cashOutAmount;
        return $totalAmount;

    }
}
