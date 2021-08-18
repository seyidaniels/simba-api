<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Transaction extends model
{


    protected $fillable = [
        'sender', 'receiver', 'currency', 'amount_in_transaction_currency', 'rate_at_transaction', 'reference_code'
    ];


    public function getSender(): \illuminate\database\eloquent\relations\belongsto
    {
     return $this->belongsto(User::class, 'sender', 'id');
    }

    public function getReceiver(): \illuminate\database\eloquent\relations\belongsto
    {
        return $this->belongsto(User::class, 'receiver', 'id');
    }

    public function createWalletHistory(): void {
        if ($this->getSender->email !== 'admin@gmail.com') {
            $this->getSender->wallet->debit($this->amount_in_transaction_currency, $this->currency, $this->id);
        }
        $this->getReceiver->wallet->credit($this->amount_in_transaction_currency, $this->currency, $this->id);
    }

}
