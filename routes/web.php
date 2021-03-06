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
    Route::get('/','dashboardController@index');
    Route::get('/design',function(){
        return view('buyer.order.history');
    });
    // Route::get('/cart','searchController@addToCart');
    Route::post('/cart/add','searchController@addToCart');
    Route::get('/cart/remove','searchController@removeFromCart');
    Route::get('/cart/update','searchController@updateCartPrice');
    Route::post('/cart/set','searchController@setAmmount');

    Route::post('/checkout','checkOutController@preview');
    Route::post('/checkout/proceed','checkOutController@proceed');
    Route::get('/orders','checkOutController@history');
    Route::get('/orders/detail','checkOutController@detail');
    Route::post('/order/confirm','checkOutController@confirm');

    Route::get('/recommendation/form','recommendationController@index');
    Route::get('/recommendation','recommendationController@searchRecommendation');

    Route::get('/search','searchController@search');
    Route::get('/detail','searchController@detail');
    Route::prefix('manage')->group(function(){
        Route::get('profile','manageUserProfileController@index');
        Route::post('profile/update/profile','manageUserProfileController@updateProfile');

        Route::get('address',"manageUserProfileController@addressIndex");
        Route::get('address/add/address','manageUserProfileController@addAddressIndex');
        Route::post('address/add/address','manageUserProfileController@addAddress');
        Route::get('address/update/address','manageUserProfileController@updateAddressIndex');
        Route::post('address/update/address','manageUserProfileController@updateAddress');

        Route::get('account',"manageUserProfileController@accountIndex");
        Route::post('account/update/email','manageUserProfileController@updateEmail');
        Route::post('account/update/password','manageUserProfileController@updatePassword');
    });
    
    //seller
    Route::get('/seller/register','shopAuthController@indexRegister');
    Route::post('/seller/register','shopAuthController@register');
   
    Route::get('/seller/dashboard','shopAuthController@indexRegister');
    Route::get('/seller/update','shopAuthController@update');
    Route::put('/seller/process','shopAuthController@process');
    //Route::get('/seller/address','shopAuthController@address');
    
    Route::get('/seller/address','shopAuthController@updateAddressIndex');
    Route::post('/seller/add/address','shopAuthController@addAddress');
    Route::post('/seller/update/address','shopAuthController@updateAddress');
    //manage product
    Route::get('/seller/product','productController@index');
    Route::get('/seller/add','productController@add');
    Route::get('/seller/edit','productController@edit');
    Route::put('/seller/addProduct','productController@addProduct');
    Route::get('/seller/product-list','productController@productList');
    Route::get('/seller/delete/{id}', 'productController@delete');
    Route::get('/seller/editProduct/{id}', 'productController@editProduct');
    Route::put('/seller/editProcess/{id}','productController@editProcess');
    Route::get('/seller/productPic','productController@productPic');
    //order
    Route::get('/seller/order','orderController@order');
    Route::get('/seller/takeOrDelivery','orderController@status');
    Route::get('/seller/cancelOrder/{id}', 'orderController@cancel');
    Route::get('/seller/processOrder/{id}', 'orderController@process');
    // Route::post('/seller/addPicture','productController@addPicture');

    Route::get('/verify/{code}','verifyController@verify');


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
        Route::get('/verify','adminController@verify');
        Route::get('/verified/{id}', 'adminController@process');
        Route::get('/manageUser','adminController@manage');
        Route::get('/banList','adminController@banList');
        Route::get('/banForm/{id}','adminController@form');
        Route::post('/processBan/{id}','adminController@ban');
        Route::get('/revoke/{id}','adminController@revoke');

    });
});


