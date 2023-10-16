<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/users/listings', [UserController::class, 'listings'])->name('users.listings');
Route::resource('', IndexController::class);
Route::resource('listings', ListingController::class);
Route::resource('users', UserController::class);
Route::post('/users/authenticate', [UserController::class, 'authenticate'])->name('users.auth');
Route::post('/users/logout', [UserController::class, 'logout'])->name('users.logout');
