<?php

use App\Http\Controllers\Admin\CustomersController;
use App\Http\Controllers\Admin\NumbersController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Auth\Account\DashboardController;
use App\Http\Controllers\Auth\Account\MyOrdersController;
use App\Http\Controllers\Auth\Account\ShowNumbersController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;


// Redirect default route "/" to the register page
Route::redirect('/', '/register');


Route::middleware(['guest'])->group(function () {
    // register routes
    Route::get('/register',[RegisterController::class, 'index'])->middleware('prevent-back-history')->name('register');
    Route::post('/process-register',[RegisterController::class, 'processRegister'])->middleware('prevent-back-history')->name('processRegister');
    // login routes
    Route::get('/login',[LoginController::class, 'index'])->middleware('prevent-back-history')->name('login');
    Route::post('/authenticate',[LoginController::class, 'authenticate'])->middleware('prevent-back-history')->name('authenticate');
});


Route::middleware(['auth', 'prevent-back-history'])->prefix('account')->group(function () {
    // Dashboard route
    Route::get('/index', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/list-numbers', [ShowNumbersController::class, 'index'])->name('showNumbers');
    Route::post('/buy-number/{id}', [ShowNumbersController::class, 'buyNumber'])->name('buy.number');
    Route::get('/my-orders', [MyOrdersController::class, 'index'])->name('myOrders');
    // Apply 'admin' middleware only to the NumbersController resource routes
    Route::middleware('admin')->group(function () {
        Route::resource('numbers', NumbersController::class);
        Route::get('/manage-customers', [CustomersController::class, 'manageUsers'])->name('manageUsers');
        Route::get('/manage-orders', [OrdersController::class, 'manageOrders'])->name('manageOrders');
        Route::put('/orders/{id}', [OrdersController::class, 'update'])->name('orders.update');
        Route::delete('/orders/{id}', [OrdersController::class, 'destroy'])->name('orders.destroy');
    });

    // Logout route
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});





