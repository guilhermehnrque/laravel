<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Controllers
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;

// User routes
Route::get('/', function () {
    return 'backend running';
});

// Users
Route::group(['prefix' => 'user'], function () {
    Route::post('create', 'UserController@store');
});

// Wallters
Route::group(['prefix' => 'wallet'], function () {
    Route::post('create', 'WalletController@store');
    Route::patch('income/{id}', 'WalletController@update');
    Route::patch('transfer/{id}', 'WalletController@transfer');
});
