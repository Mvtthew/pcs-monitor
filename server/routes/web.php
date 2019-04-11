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

Route::get('/', 'PagesController@getHome');

Route::prefix('user')->group(function () {
    Route::get('dashboard', 'UserController@getDashboard');
});

Auth::routes();
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
});