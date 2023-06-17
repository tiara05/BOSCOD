<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransferController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth', 'middleware' => 'api'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController ::class, 'login']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('profile', [AuthController::class, 'profile']);
    Route::post('logout', [AuthController::class, 'logout']);
   
});
Route::group(['prefix' => '/', 'middleware' => 'api'], function () {
    Route::post('transfer', [TransferController::class, 'transfer']);
    Route::get('generate', [TransferController::class, 'generateIdTransaksi']);
});

