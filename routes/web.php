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
            Route::get('{category_id}/details', App\Livewire\Panel\Admin\ProductManagement\Categories\Details::class)->name('details');
            Route::get('{category_id}/edit', App\Livewire\Panel\Admin\ProductManagement\Categories\Edit::class)->name('edit');
        });
        Route::prefix('brands')->name('brands.')->group(function () {
            Route::get('list', App\Livewire\Panel\Admin\ProductManagement\Brands\Index::class)->name('list');
            Route::get('create', App\Livewire\Panel\Admin\ProductManagement\Brands\Create::class)->name('create');
            Route::get('{brand_id}/details', App\Livewire\Panel\Admin\ProductManagement\Brands\Details::class)->name('details');
            Route::get('{brand_id}/edit', App\Livewire\Panel\Admin\ProductManagement\Brands\Edit::class)->name('edit');
        });
        Route::prefix('products')->name('products.')->group(function () {
            Route::get('list', App\Livewire\Panel\Admin\ProductManagement\Products\Index::class)->name('list');
            Route::get('create', App\Livewire\Panel\Admin\ProductManagement\Products\Create::class)->name('create');
            Route::get('{product_id}/details', App\Livewire\Panel\Admin\ProductManagement\Products\Details::class)->name('details');
            Route::get('{product_id}/edit', App\Livewire\Panel\Admin\ProductManagement\Products\Edit::class)->name('edit');
        });
        Route::prefix('stock-management')->name('stock-management.')->group(function () {
            Route::prefix('units')->name('units.')->group(function () {
                Route::get('list', App\Livewire\Panel\Admin\StockManagement\Units\Index::class)->name('list');
                Route::get('create', App\Livewire\Panel\Admin\StockManagement\Units\Create::class)->name('create');
                Route::get('{unit_id}/details', App\Livewire\Panel\Admin\StockManagement\Units\Details::class)->name('details');
                Route::get('{unit_id}/edit', App\Livewire\Panel\Admin\StockManagement\Units\Edit::class)->name('edit');
            });
            Route::get('history', App\Livewire\Panel\Admin\StockManagement\History::class)->name('history');
            Route::get('new-stock', App\Livewire\Panel\Admin\StockManagement\Create::class)->name('new-stock');
            Route::get('available-stock', App\Livewire\Panel\Admin\StockManagement\AvailableStock::class)->name('available-stock');
        });
    });
});