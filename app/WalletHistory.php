<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WalletHistory extends Model
{
    protected $fillable= [
        'type', 'transaction_id', 'user_id'
    ];

    protected $appends = ['transaction'];

    public function getTransactionAttribute() {
        return Transaction::find($this->transaction_id);
    }

    public function transaction () {
        return $this->belongsTo(Transaction::class);
    }
}
