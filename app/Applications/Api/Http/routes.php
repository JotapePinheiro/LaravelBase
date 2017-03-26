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

//VIA REQUEST LOGADO
Route::middleware('auth')->get('/user-logado', function (Request $request) {
    return $request->user();
});

//VIA REQUEST NAO LOGADO
Route::get('/user', function (Request $request) {
    return $request->user();
});

//VIA BROWSER NAO LOGADO
Route::get('/users', 'UsersController@index');