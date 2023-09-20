<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::post('/users', [UserController::class, 'create']);
Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::get('/', [TransactionController::class, 'showTransactionsAndBalance']);
    Route::get('/deposit', [TransactionController::class, 'showDeposits']);
    Route::post('/deposit', [TransactionController::class, 'deposit']);
    Route::get('/withdrawal', [TransactionController::class, 'showWithdrawals']);
    Route::post('/withdrawal', [TransactionController::class, 'withdraw']);
});
