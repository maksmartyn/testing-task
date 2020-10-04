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

Route::group(['prefix' => 'auth'], function() {
	Route::post('/login', 'API\AuthController@login')
	    ->middleware('throttle:5,10');
	Route::post('/register', 'API\AuthController@register')
	    ->middleware('throttle:20,60');
    Route::post('/restore', 'API\AuthController@restore');
	Route::post('/restore/confirm', 'API\AuthController@restoreConfirm');
});
  
Route::group(['middleware' => ['auth:api','role:user']], function() {
	Route::get('/departments', 'API\DepartmentsController@index');
});
Route::group(['middleware' => ['auth:api','role:worker']], function() {
	Route::get('/workers', 'API\UserWorkerController@filter');
	Route::get('/workers/{user}', 'API\UserWorkerController@show');
});
Route::group(['middleware' => ['auth:api','role:admin']], function() {
	Route::get('/user', 'API\UserController@index');
	Route::post('/user', 'API\UserController@update');
});
