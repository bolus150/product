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

Route::get('/', 'ProductController@index');
Route::get('/product/create', 'ProductController@create');
Route::post('/product/update/{product}', 'ProductController@update');
Route::get('/product/edit/{id}', 'ProductController@edit');
Route::post('/product/store', 'ProductController@store');
Route::get('/product/delete/{id}', 'ProductController@destroy');
Route::get('/price/delete/{id}', 'PriceController@delete');
Route::get('/price/save/{id}', 'PriceController@update');
