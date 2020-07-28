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

Route::get('/', function () {
    return view('buyer.dashboard');
});
Route::get('/seller/register','shopAuthController@indexRegister');
Route::post('/seller/register','shopAuthController@register');

Route::get('/login','authController@loginIndex');
Route::get('/register','authController@registerIndex');
Route::get('/logout','authController@logout');

Route::post('/login','authController@login');
Route::post('/register','authController@register');

