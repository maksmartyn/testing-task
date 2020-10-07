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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth','role:basic']], function() {
    Route::get('/departments/grid', 'DepartmentsController@grid');
    Route::resource('/departments', 'DepartmentsController');
});

Route::group(['middleware' => ['auth','role:worker']], function() {
    Route::get('/workers/grid', 'WorkersController@grid');
    Route::resource('/workers', 'WorkersController');
});  
    
Route::group(['middleware' => ['auth','role:admin']], function() {
    Route::get('/permissions/grid', 'PermissionsController@grid');
    Route::resource('/permissions', 'PermissionsController');
    Route::get('/roles/grid', 'RolesController@grid');
    Route::resource('/roles', 'RolesController');
    Route::get('/user_workers/grid', 'UserWorkersController@grid');
    Route::resource('/user_workers', 'UserWorkersController');
    Route::get('/users/grid', 'UsersController@grid');
    Route::resource('/users', 'UsersController');
    Route::get('/work_positions/grid', 'WorkPositionsController@grid');
    Route::resource('/work_positions', 'WorkPositionsController');
});
