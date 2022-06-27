<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\Menu\MenuController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Order\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
*/

// Login
Route::group(
    [
        'as' => 'auth.',
    ],
    function () {
        Route::get('/', [LoginController::class, 'index'])
            ->middleware(['guest'])
            ->name('login');

        Route::post('authenticate', [LoginController::class, 'authenticate'])
            ->middleware(['guest'])
            ->name('authenticate');

        Route::post('logout', [LoginController::class, 'logout'])
            ->middleware(['auth'])
            ->name('logout');
    }
);

/*
|--------------------------------------------------------------------------
| Menu
|--------------------------------------------------------------------------
*/

Route::group(
    [
        'as' => 'menu.',
        'middleware' => 'auth',
        'prefix' => 'menu',
    ],
    function () {
        Route::get('', [MenuController::class, 'index'])
            ->name('index');
    }
);

/*
|--------------------------------------------------------------------------
| Cart
|--------------------------------------------------------------------------
*/

Route::group(
    [
        'as' => 'cart.',
        'middleware' => 'auth',
        'prefix' => 'keranjang',
    ],
    function () {
        Route::get('', [CartController::class, 'index'])
            ->name('index');

        Route::post('store', [CartController::class, 'store'])
            ->name('store');

        Route::get('add-item', [CartController::class, 'addItem'])
            ->name('addItem');

        Route::get('update-item', [CartController::class, 'updateItem'])
            ->name('updateItem');

        Route::get('delete-item', [CartController::class, 'deleteItem'])
            ->name('deleteItem');
    }
);

/*
|--------------------------------------------------------------------------
| Order
|--------------------------------------------------------------------------
*/

Route::group(
    [
        'as' => 'order.',
        'middleware' => 'auth',
        'prefix' => 'pesanan',
    ],
    function () {
        Route::get('', [OrderController::class, 'index'])
            ->name('index');

        Route::get('detail/{id}', [OrderController::class, 'show'])
            ->name('show');

        Route::post('update-status', [OrderController::class, 'updateStatus'])
            ->name('updateStatus');
    }
);
