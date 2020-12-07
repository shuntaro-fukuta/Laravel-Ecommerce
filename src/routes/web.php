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
    Route::get('/user/{user}', [App\Http\Controllers\Front\UserController::class, 'show'])->name('user.show');

    Route::get('/user/{user}/edit', [App\Http\Controllers\Front\UserController::class, 'edit'])->name('user.edit');
    Route::post('/user/{user}/edit', [App\Http\Controllers\Front\UserController::class, 'update']);
});
