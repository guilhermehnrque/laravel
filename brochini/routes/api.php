<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Controllers
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\TransferController;

// User routes
Route::get('/', function () {
    return 'backend running';
});

// Users
Route::group(['prefix' => 'user'], function () {
    Route::post('create', 'UserController@store');
});

// Wallets
Route::group(['prefix' => 'wallet'], function () {
    Route::post('create', 'WalletController@store');
    Route::patch('income/{id}', 'WalletController@update');
    Route::get('balance/{id}', 'WalletController@show');
});

// Transaction
Route::post('/transaction', 'TransferController@store');