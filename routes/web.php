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

// ==================== Product ===================== //

Route::get('/product', 'ProductController@index');
Route::get('/product/form', 'ProductController@create');
Route::get('/product/form/{product}', 'ProductController@edit');
Route::get('/product/{product}', 'ProductController@show');

Route::post('/product', 'ProductController@store');
Route::put('/product/{product}', 'ProductController@update');
Route::delete('/product/{product}', 'ProductController@destroy');

// ==================== Category ===================== //

Route::get('/category', 'CategoryController@index');
Route::get('/category/form', 'CategoryController@create');
Route::get('/category/form/{category}', 'CategoryController@edit');
Route::get('/category/{category}', 'CategoryController@show');

Route::post('/category', 'CategoryController@store');
Route::put('/category/{category}', 'CategoryController@update');
Route::delete('/category/{category}', 'CategoryController@destroy');

// ==================== User ===================== //

Route::get('/user', 'UserController@index');
Route::get('/user/form', 'UserController@create');
Route::get('/user/form/{user}', 'UserController@edit');
Route::get('/user/{user}', 'UserController@show');

Route::post('/user', 'UserController@store');
Route::put('/user/{user}', 'UserController@update');
Route::delete('/user/{user}', 'UserController@destroy');
