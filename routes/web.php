<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/bookings', [App\Http\Controllers\BookingController::class, 'store']);
Route::get('/bookings/search', [App\Http\Controllers\BookingController::class, 'search']);