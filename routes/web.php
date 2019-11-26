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

require __DIR__.'/frontend.php';



Auth::routes();

require __DIR__.'/seller_routes.php';



// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin/login', 'Admin\AdminLoginController@showAdminLoginForm')->name('admin.login');
Route::post('/admin/login', 'Admin\AdminLoginController@adminLogin');
Route::post('/admin/logout', 'Admin\AdminLoginController@logout')->name('admin.logout');


Route::get('City/list/{state_id}', 'Admin\Configuration\ConfigurationController@cityWithState')->name('city_fetch_with_state_id');


Route::group(['middleware'=>'auth:admin','prefix'=>'admin','namespace'=>'Admin'],function(){

	require __DIR__.'/product_routes.php';

	Route::group(['namespace'=> 'Users'], function(){
		Route::get('/sellers/List','UsersController@allSellers')->name('admin.allSellers');
		Route::get('Ajax/sellers/','UsersController@ajaxAllSellers')->name('admin.ajaxAllSellers');

		Route::get('/Buyers/List','UsersController@allBuyers')->name('admin.allBuyers');
		Route::get('Ajax/Buyers/','UsersController@ajaxAllBuyers')->name('admin.ajaxAllBuyers');

		Route::get('/Seller/Details/{seller_id}','UsersController@sellerView')->name('admin.seller_view');
		Route::get('/Seller/verification/{seller_id}','UsersController@sellerUpdateVerification')->name('admin.sellerUpdateVerification');
		Route::get('/Seller/Status/{seller_id}/{status}','UsersController@sellerUpdateStatus')->name('admin.sellerUpdateStatus');
	});

	Route::group(['namespace'=>'Order','prefix'=>'Order'],function(){
		Route::get('Membership','OrderController@membershipList')->name('admin.membership_order_list');
		Route::get('ajax/Membership','OrderController@membershipListAjax')->name('admin.membership_order_list_ajax');
	});
	 
	Route::get('/deshboard', 'AdminDeshboardController@index')->name('admin.deshboard');

	//////////////Configuration ////////////////////////////////

	Route::group(['namespace'=> 'Configuration'], function(){		

		//*******************State Routes*********************

		Route::get('State/Add', 'ConfigurationController@ViewStateForm')->name('admin.view_state_form');
		Route::post('State/Add', 'ConfigurationController@AddStateForm')->name('admin.add_state');
		Route::get('State/Edit/{id}', 'ConfigurationController@EditState')->name('admin.edit_state');
		Route::post('State/Update', 'ConfigurationController@updateState')->name('admin.update_state');
		Route::get('State/Delete/{id}', 'ConfigurationController@deleteState')->name('admin.delete_state');

		//*******************City Routes*********************

		Route::get('City/Add', 'ConfigurationController@ViewCityForm')->name('admin.view_city_form');
		Route::post('City/Add', 'ConfigurationController@AddCity')->name('admin.add_city');
		Route::get('City/List', 'ConfigurationController@cityList')->name('admin.city_list');
		Route::get('Ajax/City/List', 'ConfigurationController@ajaxCityList')->name('admin.ajax_city_list');
		Route::get('City/Edit/{id}', 'ConfigurationController@EditCity')->name('admin.edit_city');
		Route::post('City/Update', 'ConfigurationController@updateCity')->name('admin.update_city');
		Route::get('City/Delete/{id}', 'ConfigurationController@deleteCity')->name('admin.delete_city');
	});

});


//////////////////// Routes For accessing admin And seller /////////////////////////////

Route::group(['middleware'=>'auth:admin,seller','prefix'=>'admin','namespace'=>'Admin'],function(){


});