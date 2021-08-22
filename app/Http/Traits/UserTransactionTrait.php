<?php


namespace App\Http\Traits;

use App\Currency;
use App\UserWallet;
use App\WalletHistory;
use Illuminate\Support\Facades\Log;

trait UserTransactionTrait {


    public function createWalletForCurrencies() {
        $currencies = Currency::all();
        foreach ($currencies as $currency) {
            UserWallet::create([
                'user_id' => $this->id,
                'balance' => 0,
                'currency_id' => $currency->id
            ]);
        }
    }


    public function wallets(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(UserWallet::class);
    }

    public function getWallet($currency_id) {
        return $this->wallets->where("currency_id", $currency_id)->first();
    }

    public function debit($amount, $currency, $transaction) {
        $wallet = $this->getWallet($currency);
        $wallet->update([
           'balance' => $wallet->balance - $amount,
        ]);
        $this->createWalletHistory('debit', $transaction);
    }

    public function credit($amount, $currency, $transaction)  {
        $wallet = $this->getWallet($currency);
        Log::info('wallet', [$wallet]);
        $wallet->update([
            'balance' => $wallet->balance + $amount,
        ]);
        $this->createWalletHistory('credit', $transaction);
    }

    public function walletHistory(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(WalletHistory::class);
    }

    public function createWalletHistory($type, $transactionId) {
        WalletHistory::create([
            'type' => $type,
            'transaction_id' => $transactionId,
            'user_id' => $this->id,
        ]);
    }
}
