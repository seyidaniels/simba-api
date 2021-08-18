<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = [
      'user_id', 'naira_amount', 'dollar_amount', 'pounds_amount'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function credit($amount, $currency, $transactionId): void {
        $this->createWalletHistory('credit', $transactionId);
        //TODO constants
        //TODO Switch casing would be better
        if ($currency  === 'USD') {
            $this->update([
                'dollar_amount' => $this->dollar_amount + $amount
            ]);
        }else if ($currency === 'NGN') {
            $this->update([
                'naira_amount' => $this->naira_amount + $amount
            ]);
        }else {
            $this->update([
                'pounds_amount' => $this->pounds_amount + $amount
            ]);
        }
    }

    public function debit($amount, $currency, $transactionId): void {
        $this->createWalletHistory('debit', $transactionId);
        if ($currency  === 'USD' && $this->dollar_amount >= $amount) {
            $this->update([
                'dollar_amount' => $this->dollar_amount - $amount
            ]);
        }else if ($currency === 'NGN' && $this->naira_amount >= $amount) {
            $this->update([
                'naira_amount' => $this->naira_amount - $amount
            ]);
        }else if ($currency === 'BGP' && $this->pounds_amount >= $amount) {
            $this->update([
                'pounds_amount' => $this->pounds_amount - $amount
            ]);
        }
    }

    public function createWalletHistory($type, $transactionId) {
        WalletHistory::create([
            'type' => $type,
            'transaction_id' => $transactionId,
            'user_id' => $this->user->id,
        ]);
    }
}
