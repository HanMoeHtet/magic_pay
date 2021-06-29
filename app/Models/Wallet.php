<?php

namespace App\Models;

use App\Helpers\GenerateRandomNumber;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        self::creating(function (Wallet $wallet) {
            $wallet->account_number = GenerateRandomNumber::gen(Wallet::class, 'account_number');
        });
    }
}
