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

Route::get('/top', [App\Http\Controllers\HomeController::class, 'index'])->name('top');

Route::group(['namespace' => 'App\Http\Controllers\Front\\'], function () {
    Route::group(['namespace' => 'Auth\\'], function () {
        Route::get('/login', 'LoginController@showLoginForm')->name('login');
        Route::post('/login', 'LoginController@login');
        Route::post('/logout', 'LoginController@logout')->name('logout');
        Route::get('/register', 'RegisterController@showRegistrationForm')->name('register');
        Route::post('/register', 'RegisterController@register');
    });

    Route::group(['middleware' => 'auth', 'prefix' => 'user', 'as' => 'user.', ], function () {
        Route::group(['middleware' => 'identification'], function () {
            Route::get('/{user}', 'UserController@show')->name('show');

            Route::get('/{user}/edit', 'UserController@edit')->name('edit');
            Route::post('/{user}/edit', 'UserController@update');

            Route::get('/{user}/withdraw', 'UserController@confirmWithdraw')->name('withdraw');
            Route::delete('/{user}/withdraw', 'UserController@withdraw');
        });
        Route::get('/withdrawal/complete', 'UserController@completeWithdrawal')->name('withdrawal.complete');
    });
});

Route::group(['prefix' => 'back', 'namespace' => 'App\Http\Controllers\Back\\', 'as' => 'back.'], function () {
    Route::group(['as' => 'operator.'], function () {
        Route::group(['guest:operator', 'namespace' => 'Auth\\'], function () {
            Route::get('/login', 'LoginController@showLoginForm')->name('login');
            Route::post('/login', 'LoginController@login');
        });

        Route::group(['middleware' => 'auth:operator'], function () {
            Route::get('/', function () { return view('back.top'); })->name('top');

            Route::group(['prefix' => 'operator'], function () {
                Route::get('/menu', 'OperatorController@menu')->name('menu');
                Route::get('/index', 'OperatorController@index')->name('index');
                Route::get('/{operator}', 'OperatorController@show')->name('show');
                Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
            });
        });
    });

    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::group(['middleware' => 'auth:operator'], function () {
            Route::get('/', 'UserController@menu')->name('menu');
            Route::get('/index', 'UserController@index')->name('index');
            Route::get('/{user}', 'UserController@show')->name('show');
        });
    });
});
