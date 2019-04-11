<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', 'ApiController@login');


// Users API
Route::middleware('auth:api')->prefix('user')->group(function () {
    Route::get('machines', 'ApiController@getMachines');
    Route::post('renewPassword', 'ApiController@renewPassword');
});


// Machines API
Route::prefix('machine')->group(function () {
    Route::post('new', 'ApiController@registerMachine');
    Route::post('report', 'ApiController@reportMachine');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
