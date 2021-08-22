<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserWallet extends Model
{
    protected $fillable = [
        'user_id', 'currency_id', 'balance'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function currency(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }
}
