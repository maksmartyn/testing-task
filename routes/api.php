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
  
Route::group(['middleware' => ['auth:api','role:basic']], function() {
	Route::get('/departments', 'API\DepartmentsController@index');
});
Route::group(['middleware' => ['auth:api','role:worker']], function() {
	Route::get('/workers', 'API\UserWorkerController@filter');
	Route::get('/workers/{user}', 'API\UserWorkerController@show');
});
Route::group(['middleware' => ['auth:api','role:admin']], function() {
	Route::get('/user', 'API\UserController@show');
	Route::post('/user', 'API\UserController@update');
	Route::get('/user/index', 'API\UserController@index');
	Route::post('/user/create', 'API\UserController@store');
	Route::post('/user/delete', 'API\UserController@destroy');

	Route::get('/departments/show', 'API\DepartmentsController@show');
	Route::post('/departments/update', 'API\DepartmentsController@update');
	Route::get('/departments/index', 'API\DepartmentsController@index');
	Route::post('/departments/create', 'API\DepartmentsController@store');
	Route::post('/departments/delete', 'API\DepartmentsController@destroy');

	Route::post('/workers/update', 'API\WorkersController@update');
	Route::get('/workers/index', 'API\WorkersController@index');
	Route::post('/workers/create', 'API\WorkersController@store');
	Route::post('/workers/delete', 'API\WorkersController@destroy');

	Route::get('/workposition/show', 'API\WorkPositionController@show');
	Route::post('/workposition/update', 'API\WorkPositionController@update');
	Route::get('/workposition/index', 'API\WorkPositionController@index');
	Route::post('/workposition/create', 'API\WorkPositionController@store');
	Route::post('/workposition/delete', 'API\WorkPositionController@destroy');

	Route::get('/userworker/show', 'API\UserWorkerController@show');
	Route::post('/userworker/update', 'API\UserWorkerController@update');
	Route::get('/userworker/index', 'API\UserWorkerController@index');
	Route::post('/userworker/create', 'API\UserWorkerController@store');
	Route::post('/userworker/delete', 'API\UserWorkerController@destroy');
});
