<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        self::created(function (User $user) {
            $wallet = new Wallet();
            $wallet->user_id = $user->id;
            $wallet->save();
        });
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function getAccountNumberAttribute()
    {
        return join('-', str_split($this->wallet->account_number, 4));
    }

    public function getBalanceAttribute()
    {
        return number_format($this->wallet->balance);
    }
}
