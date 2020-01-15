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

/*Métodos das rotas*/
Route::get('/', ['uses' => 'Controller@homePage']);
Route::get('/cadastro', ['uses' => 'Controller@cadastro']);



/* Rotas para autenticação de usuário*/

Route::get('/login', ['uses' => 'Controller@telaLogin']);
Route::post('/login', ['as' => 'user.login', 'uses' => 'Controller@telaLogin']);