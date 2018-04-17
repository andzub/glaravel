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

Route::get('/', 'PostController@index');

Route::post('/', 'Auth\RegisterController@create');

Route::post('/logout', 'Auth\RegisterController@logout');

Route::get('/edit', 'PostController@create');

Route::get('/{post}', 'PostController@show');

Route::post('/edit', 'PostController@store');

Route::get('/edit/{post}', 'PostController@edit');

Route::patch('/{post}', 'PostController@update');

Route::delete('/delete/{post}', 'PostController@destroy');



