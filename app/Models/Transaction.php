<?php

namespace App\Models;

use App\Helpers\GenerateRandomNumber;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'benefactor_id', 'beneficiary_id', 'amount'];

    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        self::creating(function (Transaction $transaction) {
            $transaction->id = GenerateRandomNumber::gen(Transaction::class, 'id');
        });

        self::created(function (Transaction $transaction) {
            $benefactor = User::find($transaction->benefactor_id);
            $beneficiary = User::find($transaction->beneficiary_id);
            $amount = $transaction->amount;

            $benefactor->wallet->decrement('balance', $amount);
            $beneficiary->wallet->increment('balance', $amount);
        });
    }

    public function benefactor()
    {
        return $this->belongsTo(User::class, 'benefactor_id');
    }

    public function beneficiary()
    {
        return $this->belongsTo(User::class, 'beneficiary_id');
    }
}
