<?php

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function () {
    Route::get('users', [UserController::class, 'getUsers']);

    Route::put('users/{id}/details', [UserController::class, 'updateUserDetails'])
        ->whereNumber('id');

    Route::delete('users/{id}', [UserController::class, 'delete'])
        ->whereNumber('id');

    Route::get('transactions', [TransactionController::class, 'getTransactions']);

});
