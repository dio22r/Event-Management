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
use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index');

Route::get('/login', 'Auth\LoginController@form')->name("login");
Route::post('/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout')->name("logout");

Route::get('/idcard/{key}', 'IdCardDataController@showEvents');
Route::get('/idcard/{key}/print', 'IdCardDataController@printIdCard');

Route::group(["middleware" => ["auth"]], function () {

    Route::get('/dashboard', "DasboardController@index")->name('dashboard');
    Route::get('/home', fn () => view("profile.profile"));
    Route::get('/profile', fn () => view("profile.profile"))->name('profile');
    Route::get('/password', "ProfileController@edit_password")->name('change.password');
    Route::post('/password', "ProfileController@update_password");

    // ==================== User ===================== //

    Route::group(["middleware" => ["check_authorized:1"]], function () {
        Route::get('/user', 'UserController@index');
        Route::get('/user/form', 'UserController@create');
        Route::get('/user/form/{user}', 'UserController@edit');
        Route::get('/user/{user}', 'UserController@show');

        Route::post('/user', 'UserController@store');
        Route::put('/user/{user}', 'UserController@update');
        Route::delete('/user/{user}', 'UserController@destroy');
    });

    // ==================== eof User ===================== //

    Route::resource("/participant", "ParticipantController");
    Route::get("/participant/{participant}/print_idcard", "ParticipantController@printIdcard");

    Route::resource("/payment", "PaymentController");
    Route::get("/payment/{payment}/print_nota", "PaymentController@printNota");

    Route::resource("/accomodation", "AccomodationController");

    Route::resource("/event", "EventController");

    Route::get("/attendance/{key}", "AttendanceController@show");
    Route::get("/attendance/{key}/all-participant", "AttendanceController@all");

    Route::post("/attendance", "AttendanceController@store")->name('attendance.store');
    Route::get("/attendance", "AttendanceController@list")->name('attendance.list');
});
