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

// use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', 'Auth\LoginController@form')->name("login");
Route::post('/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout')->name("logout");


Route::group(["middleware" => ["auth"]], function () {

    // ==================== User ===================== //

    Route::group(["middleware" => ["is_admin"]], function () {
        Route::get('/user', 'UserController@index');
        Route::get('/user/form', 'UserController@create');
        Route::get('/user/form/{user}', 'UserController@edit');
        Route::get('/user/{user}', 'UserController@show');

        Route::post('/user', 'UserController@store');
        Route::put('/user/{user}', 'UserController@update');
        Route::delete('/user/{user}', 'UserController@destroy');
    });

    // ==================== eof User ===================== //

    Route::resource("/participant", "ParticipantController")->except(["show"])->middleware("is_registration");
    Route::get("/participant/{participant}", "ParticipantController@show");

    Route::resource("/payment", "PaymentController")->except(["show"])->middleware("is_payment");
    Route::get("/payment/{payment}", "PaymentController@show");

    Route::resource("/accomodation", "AccomodationController")->except(["show"])->middleware("is_accomodation");
    Route::get("/accomodation/{accomodation}", "AccomodationController@show");
});
