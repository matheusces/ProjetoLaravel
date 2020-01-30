<?php


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

Route::get('/', ['uses' => 'Controller@homepage']);
Route::get('/cadastro', ['uses' => 'Controller@cadastrar']);


/*
===== Rotas do user auth ======
*/

Route::get('/login', ['uses' => 'Controller@telaLogin']);
Route::post('/login', ['as' => 'user.login', 'uses' => 'DashboardController@auth']);
Route::get('/dashboard', ['as' => 'user.dashboard', 'uses' => 'DashboardController@index']);

Route::get('user', ['as' => 'user.index', 'uses' => 'UsersController@index']);

Route::get('getback', ['as' => 'moviment.getback', 'uses' => 'MovimentsController@getback']);
Route::post('getback', ['as' => 'moviment.getback.store', 'uses' => 'MovimentsController@storeGetBack']);

Route::get('moviment', ['as' => 'moviment.index', 'uses' => 'MovimentsController@index']);
Route::post('moviment', ['as' => 'moviment.store', 'uses' => 'MovimentsController@store']);
Route::get('user/moviment', ['as' => 'moviment.application', 'uses' => 'MovimentsController@application']);
Route::get('moviment/all', ['as' => 'moviment.all', 'uses' => 'MovimentsController@all']);


Route::resource('user', 'UsersController');
Route::resource('instituition', 'InstituitionsController');
Route::resource('group', 'GroupsController');
Route::resource('instituition.product', 'ProductsController');


Route::post('group/{group_id}/user', ['as' => 'group.user.store', 'uses' => 'GroupsController@userStore']);