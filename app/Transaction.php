<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Transaction extends model
{


    protected $fillable = [
        'sender', 'receiver','sender_currency', 'receiver_currency', 'amount_in_transaction_currency', 'rate_at_transaction', 'reference_code'
    ];


    public function getSender(): \illuminate\database\eloquent\relations\belongsto
    {
     return $this->belongsto(User::class, 'sender', 'id');
    }

    public function getReceiver(): \illuminate\database\eloquent\relations\belongsto
    {
        return $this->belongsto(User::class, 'receiver', 'id');
    }

    public function getSenderCurrency(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Currency::class, 'sender_currency');
    }

    public function getReceiverCurrency(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Currency::class, 'receiver_currency');
    }

    public function createWalletHistory(): void {
        if ($this->getSender->email !== 'admin@gmail.com') {
            $this->getSender->debit($this->amount_in_transaction_currency, $this->getSenderCurrency->id, $this->id);
        }
        $this->getReceiver->credit($this->amount_in_transaction_currency * $this->rate_at_transaction, $this->getReceiverCurrency->id, $this->id);
    }

}
