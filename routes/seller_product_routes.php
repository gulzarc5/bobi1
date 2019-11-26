<?php
Route::group(['prefix'=>'Books'], function(){
	Route::get('Add/Form','BookController@addBookForm')->name('seller.add_book_form');
	Route::post('Add','BookController@addBook')->name('seller.insert_book');
	Route::get('Edit/{book_id}','BookController@editBookForm')->name('seller.edit_book_form');
	Route::post('update/','BookController@updateBook')->name('seller.update_book');
	Route::get('Status/Update/{book_id}/{status}','BookController@bookStatusUpdate')->name('seller.book_status_update');
	Route::get('Detail/View/{book_id}','BookController@bookDetailView')->name('seller.book_detail_view');

	Route::get('list/','BookController@bookList')->name('seller.book_list');
	Route::get('ajax/list/','BookController@ajaxBookList')->name('seller.ajax_book_list');
});

Route::group(['prefix'=>'Project'], function(){

	Route::get('Add/','ProjectController@addProjectForm')->name('seller.add_project_form');
	Route::post('insert/','ProjectController@addProject')->name('seller.insert_project');
	Route::get('Edit/{project_id}','ProjectController@editProjectForm')->name('seller.edit_project_form');
	Route::post('update/','ProjectController@projectUpdate')->name('seller.project_update');
	Route::get('Detail/View/{project_id}','ProjectController@projectDetailView')->name('seller.project_detail_view');
	Route::get('preview_file_view/{project_id}', 'ProjectController@previewFileView')->name('seller.preview_file_view')->middleware('projectFileAuthorization');
	Route::get('documentation_file_view/{project_id}', 'ProjectController@documentationFileView')->name('seller.documentation_file_view')->middleware('projectFileAuthorization');
	Route::get('synopsis_file_view/{project_id}', 'ProjectController@synopsisFileView')->name('seller.synopsis_file_view');
	Route::get('Status/Update/{project_id}/{status}','ProjectController@projectStatusUpdate')->name('seller.project_status_update');

	Route::get('list/','ProjectController@projectList')->name('seller.project_list');
	Route::get('ajax/list/','ProjectController@ajaxProjectList')->name('seller.ajax_project_list');

});

Route::group(['prefix'=>'Megazine'], function(){

	Route::get('Add/','MegazineController@addMegazineForm')->name('seller.add_new_megazine');
	Route::post('insert/','MegazineController@addMegazine')->name('seller.insert_new_megazine');
	Route::get('Edit/{megazine_id}','MegazineController@editMegazineForm')->name('seller.edit_megazine_form');
	Route::post('update/','MegazineController@megazineUpdate')->name('seller.megazine_update');
	Route::get('Detail/View/{megazine_id}','MegazineController@megazineDetailView')->name('seller.megazine_detail_view');
	Route::get('cover_image_view/{megazine_id}', 'MegazineController@coverImageView')->name('seller.cover_image_view');
	Route::get('megazine_file_view/{megazine_id}', 'MegazineController@megazineFileView')->name('seller.megazine_file_view')->middleware('megazineFileAuthorization');
	Route::get('Status/Update/{megazine_id}/{status}','MegazineController@megazineStatusUpdate')->name('seller.megazine_status_update');

	

	Route::get('list/','MegazineController@megazineList')->name('seller.megazine_list');
	Route::get('ajax/list/','MegazineController@ajaxMegazineList')->name('seller.ajax_megazine_list');
});

Route::group(['prefix'=>'Quiz'], function(){
	Route::get('Add/','QuizController@addQuizForm')->name('seller.add_new_quiz_form');
	Route::post('insert/','QuizController@addQuiz')->name('seller.insert_new_quiz');
	Route::get('Edit/{quiz_id}','QuizController@editQuizForm')->name('seller.edit_quiz_form');
	Route::post('update/','QuizController@updateQuiz')->name('seller.update_quiz');
	Route::get('Status/Update/{quiz_id}/{status}','QuizController@quizStatusUpdate')->name('seller.quiz_status_update');
	Route::get('Detail/View/{quiz_id}','QuizController@quizDetailView')->name('seller.quiz_detail_view');
	// Route::get('Download/file/{quiz_id}','QuizController@quizFileDownload')->name('admin.quiz_file_download')->middleware('fileAuthorization');


	Route::get('list/','QuizController@quizList')->name('seller.quiz_list');
	Route::get('ajax/list/','QuizController@ajaxQuizList')->name('seller.ajax_quiz_list');
});

Route::group(['prefix'=>'Order'],function(){

	Route::group(['prefix'=>'Books'],function(){
		Route::get('List/','OrderController@bookOrderList')->name('seller.book_order_list');
		Route::get('/ajax/list','OrderController@bookOrderAjaxList')->name('seller.book_order_ajax_list');
		Route::get('Detail/{order_id}','OrderController@bookOrderDetail')->name('seller.book_order_detail');

		Route::get('Status/Update/{order_id}/{status}','OrderController@bookOrderStatus')->name('seller.book_order_status');
		Route::get('Dispatch/Form/{order_id}','OrderController@BookOrderDispatchedForm')->name('seller.book_order_dispatch_form');
		Route::post('Dispatch/Submit','OrderController@BookOrderDispatched')->name('seller.book_order_dispatch');
	});

	Route::group(['prefix'=>'Project'],function(){
		Route::get('List/','OrderController@projectOrderList')->name('seller.project_order_list');
		Route::get('/ajax/list','OrderController@projectOrderAjaxList')->name('seller.project_order_ajax_list');
	});

	Route::group(['prefix'=>'Megazine'],function(){
		Route::get('List/','OrderController@megazineOrderList')->name('seller.megazine_order_list');
		Route::get('/ajax/list','OrderController@megazineOrderAjaxList')->name('seller.megazine_order_ajax_list');
	});
});