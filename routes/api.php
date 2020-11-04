<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/province","manageUserProfileController@getProvince");
Route::get("/city/{provinceId}","manageUserProfileController@getCity");
Route::get("/subdistrict/{cityId}","manageUserProfileController@getSubDistrict");
