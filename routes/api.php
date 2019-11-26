<?php

use Illuminate\Http\Request;

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
Route::group(['namespace'=>'Api'], function(){
    Route::get('category/list','CategoryController@mainCategory');
    Route::get('first/category/{main_category}','CategoryController@firstCategory');
    Route::get('second/category/{first_category}','CategoryController@secondCategory');
    
    Route::get('product/list/second/category/{second_category}/{page}','ProductController@productList');
    Route::post('product/filter','ProductController@productListWithFilter');
    Route::get('product/single/view/{product_id}','ProductController@singleProductView');
    Route::get('releted/product/{second_category}','ProductController@reletedProducts');

    Route::post('user/registration','UsersController@userRegistration');

});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
