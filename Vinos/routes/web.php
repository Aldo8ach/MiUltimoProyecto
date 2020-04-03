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

Route::get('/profile', function () {
    return "Estas en el perfl";
});

Route::group(['prefix' => 'usuarios', 'as'=>'usuarios'], function () {
    
});


Route::group(['prefix' => 'admin','as'=>'admin'], function () {
    Route::get('/', 'AdminController@index');
    Route::get('/vinos', 'VinoController@index');
    Route::get('/usuarios', 'UserController@index');
    Route::resource('usuarios', 'UserController');
    Route::resource('vinos', 'VinoController');
    Route::post('/usuarios/edit', 'UserController@editarUsuarios');
    Route::post('/vinos/edit', 'VinoController@editarVinos');
  
    
});