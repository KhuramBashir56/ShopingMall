<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::view('/', 'web.welcome')->name('home');
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
    Route::view('dashboard', 'panel.dashboard')->name('dashboard');
    Route::middleware('can:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::prefix('categories')->name('categories.')->group(function () {
            Route::get('list', App\Livewire\Panel\Admin\ProductManagement\Categories\Index::class)->name('list');
            Route::get('create', App\Livewire\Panel\Admin\ProductManagement\Categories\Create::class)->name('create');
            Route::get('details', App\Livewire\Panel\Admin\ProductManagement\Categories\Details::class)->name('details');
        });
        Route::prefix('brands')->name('brands.')->group(function () {
            Route::get('list', App\Livewire\Panel\Admin\ProductManagement\Brands\Index::class)->name('list');
            Route::get('create', App\Livewire\Panel\Admin\ProductManagement\Brands\Create::class)->name('create');
            Route::get('details', App\Livewire\Panel\Admin\ProductManagement\Brands\Details::class)->name('details');
        });
        Route::prefix('products')->name('products.')->group(function () {
            Route::get('list', App\Livewire\Panel\Admin\ProductManagement\Products\Index::class)->name('list');
            Route::get('create', App\Livewire\Panel\Admin\ProductManagement\Products\Create::class)->name('create');
            Route::get('details', App\Livewire\Panel\Admin\ProductManagement\Products\Details::class)->name('details');
        });
    });
});