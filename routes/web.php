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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/activate/{code}','Auth\RegisterController@activate');

Route::get('/', 'IndexController@index');
Route::get('/view/{url}', 'IndexController@viewDetails');
Route::post('/update', 'IndexController@update');


Route::get('/admin','Admin\AdminController@index');

Route::get('/admin/users', 'Admin\UsersController@index');
Route::get('/admin/users/users_data', 'Admin\UsersController@anyData');
Route::get('/admin/users/edit/{id}', 'Admin\UsersController@edit');
Route::post('/admin/users/update', 'Admin\UsersController@update');
Route::post('/admin/users/change_status', 'Admin\UsersController@change_status');

Route::get('/admin/trainings', 'Admin\TrainingsController@index');
Route::get('/admin/trainings/users_data', 'Admin\TrainingsController@anyData');
Route::get('/admin/trainings/edit/{id}', 'Admin\TrainingsController@edit');
Route::post('/admin/trainings/update', 'Admin\TrainingsController@update');
Route::post('/admin/trainings/change_status', 'Admin\TrainingsController@change_status');
Route::get('/admin/trainings/create', 'Admin\TrainingsController@create');

// =============================== lektors =============================================
Route::get('/admin/lektors', 'Admin\LektorsController@index');
Route::get('/admin/lektors/users_data', 'Admin\LektorsController@anyData');
Route::get('/admin/lektors/edit/{id}', 'Admin\LektorsController@edit');
Route::post('/admin/lektors/update', 'Admin\LektorsController@update');
Route::post('/admin/lektors/change_status', 'Admin\LektorsController@change_status');
Route::get('/admin/lektors/create', 'Admin\LektorsController@create');
// =========================== end lektors =============================================


// ============================== view cources==========================================
Route::get('/admin/viewTrainings', 'Admin\ViewController@viewTrainings');
Route::get('/admin/viewTrainings/users_data', 'Admin\ViewController@anyData');
Route::get('/admin/viewTrainings/view/{url}', 'Admin\ViewController@viewDetails');
// =====================================================================================

// ============================== view discounts==========================================
Route::get('/admin/discounts', 'Admin\DiscountsController@index');
Route::get('/admin/discounts/users_data', 'Admin\DiscountsController@anyData');
Route::get('/admin/discounts/add', 'Admin\DiscountsController@add');
Route::post('/admin/discounts/create', 'Admin\DiscountsController@create');
// =====================================================================================
// =========================== add request =============================================
Route::get('/admin/requests', 'Admin\RequestsController@index');
Route::get('/admin/requests/users_data', 'Admin\RequestsController@anyData');

Route::get('/admin/requests/export', 'Admin\RequestsController@viewExport');
Route::post('/admin/requests/makeExport', 'Admin\RequestsController@makeExport');

Route::get('/admin/requests/edit/{id}', 'Admin\RequestsController@edit');
Route::post('/admin/requests/update', 'Admin\RequestsController@update');
Route::post('/admin/requests/change_status', 'Admin\RequestsController@change_status');
//Route::get('/admin/requests/create', 'Admin\RequestsController@create');
// ======================= end add request =============================================




// =============================== lessons =============================================
Route::get('/admin/lessons', 'Admin\LessonsController@index');
Route::get('/admin/lessons/users_data', 'Admin\LessonsController@anyData');
Route::get('/admin/lessons/edit/{id}', 'Admin\LessonsController@edit');
Route::post('/admin/lessons/update', 'Admin\LessonsController@update');
Route::post('/admin/lessons/change_status', 'Admin\LessonsController@change_status');
Route::get('/admin/lessons/create', 'Admin\LessonsController@create');
// =========================== end lessons =============================================



Route::get('/admin/brands', 'Admin\BrandsController@index');
Route::get('/admin/brands/users_data', 'Admin\BrandsController@anyData');
Route::get('/admin/brands/edit/{id}', 'Admin\BrandsController@edit');  // ===== 2
Route::post('/admin/brands/update', 'Admin\BrandsController@update');
Route::post('/admin/brands/change_status', 'Admin\BrandsController@change_status');
Route::get('/admin/brands/create', 'Admin\BrandsController@create'); //  ----- 1

Route::post('/admin/images/upload', 'Admin\ImagesController@upload');
Route::post('/admin/images/crop', 'Admin\ImagesController@crop');
Route::post('/admin/images/apply', 'Admin\ImagesController@apply');
