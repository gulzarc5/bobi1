<?php

// Route::get('seller_login', function () {
// 	return view('web.seller-login');
// })->name('seller_login');

Route::group(['prefix'=>'Seller','namespace'=>'Seller'],function(){

	Route::post('/Login', 'SellerLoginController@sellerLogin')->name('seller.login');
	Route::post('/logout', 'SellerLoginController@logout')->name('seller.logout');

	Route::group(['middleware'=>'auth:seller'],function(){

		require __DIR__.'/seller_product_routes.php';
	 
		Route::get('/Deshboard', 'SellerController@index')->name('seller.deshboard');
		Route::get('/MyProfile', 'SellerController@myProfileForm')->name('seller.MyprofileForm');
		Route::get('/Category', 'SellerController@myCategoryForm')->name('seller.MyCategoryForm');
		Route::post('/Category/Update', 'SellerController@myCategoryUpdate')->name('seller.MyCategoryUpdate');
		Route::post('/MyProfile', 'SellerController@sellerUpdate')->name('seller.MyprofileUpdate');
		Route::get('/change/Password', 'SellerController@viewChangePasswordForm')->name('seller.change_password_form');
		Route::post('/change/Password', 'SellerController@ChangePassword')->name('seller.change_password');

		
	});
});

