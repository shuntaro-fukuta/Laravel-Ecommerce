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

Route::get('/', function () {
    return view('front.top');
});

Route::get('/login', 'App\Http\Controllers\Front\Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'App\Http\Controllers\Front\Auth\LoginController@login');
Route::post('/logout', 'App\Http\Controllers\Front\Auth\LoginController@logout')->name('logout');

Route::get('/register', 'App\Http\Controllers\Front\Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'App\Http\Controllers\Front\Auth\RegisterController@register');

Route::get('/top', [App\Http\Controllers\HomeController::class, 'index'])->name('top');

Route::group(['middleware' => 'auth'], function () {

    Route::group(['middleware' => 'identification'], function () {
        Route::get('/user/{user}', [App\Http\Controllers\Front\UserController::class, 'show'])->name('user.show');

        Route::get('/user/{user}/edit', [App\Http\Controllers\Front\UserController::class, 'edit'])->name('user.edit');
        Route::post('/user/{user}/edit', [App\Http\Controllers\Front\UserController::class, 'update']);

        Route::get('/user/{user}/withdraw', 'App\Http\Controllers\Front\UserController@confirmWithdraw')->name('user.withdraw');
        Route::delete('/user/{user}/withdraw', 'App\Http\Controllers\Front\UserController@withdraw');
    });
    Route::get('/user/withdrawal/complete', 'App\Http\Controllers\Front\UserController@completeWithdrawal')->name('user.withdrawal.complete');
});

Route::prefix('back')->group(function () {
    Route::middleware('guest:operator')->group(function () {
        Route::get('/login', 'App\Http\Controllers\Back\Auth\LoginController@showLoginForm')->name('back.operator.login');
        Route::post('/login', 'App\Http\Controllers\Back\Auth\LoginController@login');
    });

    Route::middleware('auth:operator')->group(function () {
        Route::get('/', function () {
            return view('back.top');
        })->name('back.top');

        Route::post('/logout', 'App\Http\Controllers\Back\Auth\LoginController@logout')->name('back.operator.logout');
    });
});
