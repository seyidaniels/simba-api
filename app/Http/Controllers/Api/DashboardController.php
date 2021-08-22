<?php

namespace App\Http\Controllers\Api;

use App\Currency;
use App\Http\Controllers\Controller;
use App\User;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class DashboardController extends Controller
{
    public function getUsers() {
        $users = User::all()->except(Auth::id());
        return response()->json(['users' => $users]);
    }

    public function getTransactions() {
        $user = Auth::user();
        return response()->json(['transactions', $user->walletHistory]);
    }

    public function sendFunds(Request $request) {
        $validator = $this->validateRequest($request);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ]);
        }

        // Check if user has enough
        $userCurrency = User::getWallet($request->sender_currency);

        if ($request->amount > $userCurrency->balance) {
            return response()->json([
                'error' => 'Insufficient funds',
            ], 400);
        }

       try {
            DB::beginTransaction();
           $senderCurrency = Currency::where('code', $request->sender_currency)->first();

           $transaction = Transaction::create([
               'sender' => Auth::id(),
               'receiver' => $request->receiver_id,
               'sender_currency' => $request->sender_currency,
               'receiver_currency' => $request->receiver_currency,
               'amount_in_transaction_currency' => $request->amount,
               'rate_at_transaction' => $senderCurrency->rate,
               'reference_code' => Str::random(20)
           ]);

           $transaction->createWalletHistory();

           DB::commit();

       }catch(\Exception $e) {
            DB::rollBack();
            return response()->json([
                    'message' => 'an error occurred'
            ], 500);
        }

    }


    public function validateRequest($request): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($request->all(), [
            'sender_currency' => ['required',  'exists:currencies'],
            'amount' => ['required', 'numeric'],
            'receiver_currency' => ['required', 'exists:currencies'],
            'receiver_id' => ['required', 'numeric', 'exists:users', ]
        ]);
    }

}
