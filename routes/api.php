<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DashboardController;



// Auth Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// Dashboard Routes
Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('/transactions', [DashboardController::class, 'getTransactions']);
    Route::get('/users', [DashboardController::class, 'getUsers']);
});