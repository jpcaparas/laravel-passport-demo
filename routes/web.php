<?php

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

Route::get('/', function() {
    return redirect()->route('user.profile');
});

Route::group(['prefix' => 'users', 'middleware' => 'auth.basic'], function () {
    Route::get('profile', '\App\Http\Controllers\Web\UserController@showProfile')->name('user.profile');
});
