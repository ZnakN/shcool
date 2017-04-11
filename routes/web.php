<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/activate/{code}','Auth\RegisterController@activate');

Route::get('/home', 'HomeController@index');

Route::get('/admin','Admin\AdminController@index');

Route::get('/admin/users', 'Admin\UsersController@index');
Route::get('/admin/users/users_data', 'Admin\UsersController@anyData');
Route::get('/admin/users/edit/{id}', 'Admin\UsersController@edit');
Route::post('/admin/users/update', 'Admin\UsersController@update');
Route::post('/admin/users/change_status', 'Admin\UsersController@change_status');

Route::get('/admin/brands', 'Admin\BrandsController@index');
Route::get('/admin/brands/users_data', 'Admin\BrandsController@anyData');
Route::get('/admin/brands/edit/{id}', 'Admin\BrandsController@edit');
Route::post('/admin/brands/update', 'Admin\BrandsController@update');
Route::post('/admin/brands/change_status', 'Admin\BrandsController@change_status');
Route::get('/admin/brands/create', 'Admin\BrandsController@create');

Route::post('/admin/images/upload', 'Admin\ImagesController@upload');
Route::post('/admin/images/crop', 'Admin\ImagesController@crop');
Route::post('/admin/images/apply', 'Admin\ImagesController@apply');
