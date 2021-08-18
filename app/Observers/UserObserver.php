<?php

namespace App\Observers;

use App\User;
use App\Wallet;
use App\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {
        Log::info('gets here', []);
        try {
            DB::beginTransaction();
            $admin = User::find(1);
            Wallet::create([
                'user_id' => $user->id
            ]);
            $transaction = Transaction::create([
                'sender' => $admin->id,
                'receiver' => $user->id,
                'amount_in_transaction_currency' => 1000,
                'currency' => 'USD',
                'reference_code' => Str::random(20)
            ]);
            $transaction->createWalletHistory();
            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            //TODO Notify admin and run a job that tries this action again
            Log::error('Failure', [
                'data' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
