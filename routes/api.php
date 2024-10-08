<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CleanerController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/bookings', [App\Http\Controllers\BookingController::class, 'store']);
Route::get('/bookings/search', [App\Http\Controllers\BookingController::class, 'search']);
// Fetch all bookings
Route::get('/getbookings', [App\Http\Controllers\BookingController::class, 'index']);

Route::put('/bookings/{id}/{action}', [App\Http\Controllers\BookingController::class, 'updateStatus']);
Route::post('/cleaner/register', [CleanerController::class, 'register']);
Route::get('/admin/cleaners/pending', [CleanerController::class, 'getPendingApplications']);
Route::post('/admin/cleaner/{id}/status', [CleanerController::class, 'updateApplicationStatus']);
