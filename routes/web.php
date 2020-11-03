<?php

use Illuminate\Support\Facades\Route;

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

Route::middleware(['islogin'])->group(function () {
    Route::get('/', function () {
        return view('buyer.dashboard');
    });
    Route::get('/seller/register','shopAuthController@indexRegister');
    Route::post('/seller/register','shopAuthController@register');
//new
    Route::get('/seller/update','shopAuthController@update');
    Route::post('/seller/process','shopAuthController@process');
    
    Route::get('/verify/{code}','verifyController@verify');

    Route::get('/logout','authController@logout');

});
Route::get('/mail','mailTest@send');
Route::middleware(['isnotlogin'])->group(function () {
    Route::get('/login','authController@loginIndex');
    Route::get('/register','authController@registerIndex');
    
    Route::post('/login','authController@login');
    Route::post('/register','authController@register');
});



