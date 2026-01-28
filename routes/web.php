<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionsController;
use App\Http\Middleware\CheckSession;

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);

Route::middleware([CheckSession::class])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/transactions', [TransactionsController::class, 'index'])->name('transactions.index');
    Route::post('/store', [TransactionsController::class, 'store'])->name('transactions.store');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

