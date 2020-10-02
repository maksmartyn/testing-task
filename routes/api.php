<?php

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Route;

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
	Route::post('login', 'API\AuthController@login');
    Route::post('register', 'API\AuthController@register');
    Route::post('restore', 'API\AuthController@restore');
	Route::post('restore/confirm', 'API\AuthController@confirmRestore');
});
  
Route::group(['middleware' => 'auth:api'], function() {
	Route::get('departments', 'API\DepartmentsController@index');
	Route::get('workers', 'API\WorkersController@index');
	Route::get('workers/{user}', 'API\UserWorkerController@index');
	Route::get('user', 'API\UserController@index');
	Route::post('user', 'API\UserController@update');
});
