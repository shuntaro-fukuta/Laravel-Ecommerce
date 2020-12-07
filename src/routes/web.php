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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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
