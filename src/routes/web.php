<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'top'])->name('top');
Route::get('/top', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/cart', [App\Http\Controllers\Front\CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [App\Http\Controllers\Front\CartController::class, 'show'])->name('cart.show');
Route::post('/carts/{janCode}/increment', [App\Http\Controllers\Front\CartController::class, 'incrementQuantity'])->name('cart.incrementQuantity');
Route::post('/carts/{janCode}/decrement', [App\Http\Controllers\Front\CartController::class, 'decrementQuantity'])->name('cart.decrementQuantity');

Route::group(['namespace' => 'App\Http\Controllers\Front\\'], function () {
    Route::group(['namespace' => 'Auth\\'], function () {
        Route::get('/login', 'LoginController@showLoginForm')->name('login');
        Route::post('/login', 'LoginController@login');
        Route::post('/logout', 'LoginController@logout')->name('logout');
        Route::get('/register', 'RegisterController@showRegistrationForm')->name('register');
        Route::post('/register', 'RegisterController@register');
    });

    Route::get('/products/{product}', 'ProductController@show')->name('products.show');

    Route::middleware('auth:user')->group(function () {
        Route::middleware('identification')->group(function () {
            Route::resource('users', 'UserController')->only(['show', 'edit', 'update', 'destroy']);
            Route::get('/users/{user}/withdraw', 'UserController@confirmWithdraw')->name('users.withdraw');
        });
    });

    Route::middleware('guest:user')->group(function () {
        Route::get('/withdrawal/complete', 'UserController@completeWithdrawal')->name('users.withdrawal.complete');
    });
});

Route::group(['prefix' => 'back', 'namespace' => 'App\Http\Controllers\Back\\', 'as' => 'back.'], function () {
    Route::group(['guest:operator', 'namespace' => 'Auth\\'], function () {
        Route::get('/login', 'LoginController@showLoginForm')->name('operators.login');
        Route::post('/login', 'LoginController@login');
    });

    Route::middleware('auth:operator')->group(function () {
        Route::get('/', function () { return view('back.top'); })->name('top');

        Route::get('/operators/menu', 'OperatorController@menu')->name('operators.menu');
        Route::resource('operators', 'OperatorController')->only(['index', 'show']);

        Route::get('/users/menu', 'UserController@menu')->name('users.menu');
        Route::resource('users', 'UserController');

        Route::resource('makers', 'MakerController');
        Route::get('/maker/menu', 'MakerController@menu')->name('makers.menu');

        Route::get('/categories/menu', 'CategoryController@menu')->name('categories.menu');
        Route::resource('categories', 'CategoryController')->only(['index', 'show', 'create', 'store', 'edit', 'update']);

        Route::get('/products/menu', 'ProductController@menu')->name('products.menu');
        Route::resource('products', 'ProductController');
    });
});
