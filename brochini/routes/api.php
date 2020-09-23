<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\TransferController;

// Users
Route::group(['prefix' => 'user'], function () {
    Route::post('create', [UserController::class, 'store']);
});

// Wallets
Route::group(['prefix' => 'wallet'], function () {
    Route::post('create', [WalletController::class, 'store']);
    Route::patch('income/{id}', [WalletController::class, 'update']);
    Route::get('balance/{id}', [WalletController::class, 'show']);
});

// Transaction
Route::post('/transaction', [TransferController::class, 'store']);