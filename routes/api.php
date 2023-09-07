<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\DriversController;

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
Route::post('/signup',[AuthController::class,'signup']);
Route::post('/signin',[AuthController::class,'signin']);

Route::get('/drivers', [DriversController::class, 'index']);

Route::post('/bookings',[BookingsController::class,'create']);
Route::get('/bookings',[BookingsController::class,'index']);
Route::get('/bookings/{id}',[BookingsController::class,'show']);
Route::put('/bookings/{id}/accept',[BookingsController::class,'accept']);
Route::put('/bookings/{id}/reject',[BookingsController::class,'reject']);
