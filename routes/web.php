<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Route::view('/', 'welcome')->name('home');
/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::resource('login', App\Http\Controllers\Auth\AuthenticatedSessionController::class)->only('index', 'store');
    Route::resource('register', App\Http\Controllers\Auth\RegisteredUserController::class)->only('index', 'store');
});
/*
|--------------------------------------------------------------------------
| Panel Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::post('logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');
});