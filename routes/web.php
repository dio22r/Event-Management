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


Route::get('/login', 'Auth\LoginController@form')->name("login");
Route::post('/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout')->name("logout");

// ==================== Product ===================== //

Route::get('/home', 'ProductController@index')->middleware('auth');

Route::get('/product', 'ProductController@index')->middleware('auth');
Route::get('/product/form', 'ProductController@create')->middleware('auth');
Route::get('/product/form/{product}', 'ProductController@edit')->middleware('auth');
Route::get('/product/{product}', 'ProductController@show')->middleware('auth');

Route::post('/product', 'ProductController@store')->middleware('auth');
Route::put('/product/{product}', 'ProductController@update')->middleware('auth');
Route::delete('/product/{product}', 'ProductController@destroy')->middleware('auth');

// ==================== Category ===================== //

Route::get('/category', 'CategoryController@index')->middleware('auth');
Route::get('/category/form', 'CategoryController@create')->middleware('auth');
Route::get('/category/form/{category}', 'CategoryController@edit')->middleware('auth');
Route::get('/category/{category}', 'CategoryController@show')->middleware('auth');

Route::post('/category', 'CategoryController@store')->middleware('auth');
Route::put('/category/{category}', 'CategoryController@update')->middleware('auth');
Route::delete('/category/{category}', 'CategoryController@destroy')->middleware('auth');

// ==================== User ===================== //

Route::get('/user', 'UserController@index')->middleware('auth');
Route::get('/user/form', 'UserController@create')->middleware('auth');
Route::get('/user/form/{user}', 'UserController@edit')->middleware('auth');
Route::get('/user/{user}', 'UserController@show')->middleware('auth');

Route::post('/user', 'UserController@store')->middleware('auth');
Route::put('/user/{user}', 'UserController@update')->middleware('auth');
Route::delete('/user/{user}', 'UserController@destroy')->middleware('auth');
