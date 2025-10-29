<?php

use App\Http\Controllers\SslcommerzController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(SslcommerzController::class)
    ->prefix('sslcommerz') // adds /sslcommerz to the URL
    ->name('sslc.')        // adds a route name prefix like sslc.success
    ->group(function () {
        Route::post('success', 'success')->name('success');
        Route::post('failure', 'failure')->name('failure');
        Route::post('cancel', 'cancel')->name('cancel');
        Route::post('ipn', 'ipn')->name('ipn');
    });
Route::post('/pay-now', [App\Http\Controllers\PaymentController::class, 'payNow'])->name('pay.now');