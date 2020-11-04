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
    Route::prefix('manage')->group(function(){
        Route::get('profile','manageUserProfileController@index');
        Route::post('profile/update/profile','manageUserProfileController@updateProfile');

        Route::get('address',"manageUserProfileController@addressIndex");
        Route::get('address/add/address','manageUserProfileController@addAlamatIndex');
        Route::post('address/add/address','manageUserProfileController@addAlamat');
        Route::get('address/update/address','manageUserProfileController@updateAlamatIndex');
        Route::post('address/update/address','manageUserProfileController@updateAlamat');

        Route::get('account',"manageUserProfileController@accountIndex");
        Route::post('account/update/email','manageUserProfileController@updateEmail');
        Route::post('account/update/password','manageUserProfileController@updatePassword');
    });
    

    Route::get('/seller/register','shopAuthController@indexRegister');
    Route::post('/seller/register','shopAuthController@register');

    Route::get('/logout','authController@logout');

});

Route::middleware(['isnotlogin'])->group(function () {
    Route::get('/login','authController@loginIndex');
    Route::get('/register','authController@registerIndex');
    
    Route::post('/login','authController@login');
    Route::post('/register','authController@register');
});


Route::prefix('admin')->group(function (){
    Route::get('/login','adminController@loginPage');
    Route::post('/login','adminController@login');
    Route::middleware(['isadmin'])->group(function (){
        Route::get('/home','adminController@home');
    });
});


