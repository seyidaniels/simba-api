<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


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

}
