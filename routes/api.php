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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('credits', 'CreditsController@index');
Route::get('credits/{id}', 'CreditsController@show');
Route::post('credits', 'CreditsController@save');
Route::put('credits/{credit}', 'CreditsController@update');
Route::delete('credits/{credit}', 'CreditsController@delete');
Route::get('movies/user/{userid}/searchFor/', 'CreditsController@searchFor')->where(['userid'=>'[0-9]+']);
Route::get('movies/user/{userid}/search/', 'CreditsController@search')->where(['userid'=>'[0-9]+']);
