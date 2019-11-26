<?php

Route::group(['namespace'=> 'Books','prefix'=>'Book'], function(){

	Route::get('Add/','BookController@addBookForm')->name('admin.add_new_book');
	Route::post('insert/','BookController@addBook')->name('admin.insert_new_book');
	Route::get('Edit/{book_id}','BookController@editBookForm')->name('admin.edit_book_form');
	Route::post('update/','BookController@updateBook')->name('admin.update_book');
	Route::get('Status/Update/{book_id}/{status}','BookController@bookStatusUpdate')->name('admin.book_status_update');
	Route::get('Approve/{book_id}/{status}','BookController@bookApprove')->name('admin.book_approve');

	Route::get('Detail/View/{book_id}','BookController@bookDetailView')->name('admin.book_detail_view');


	Route::get('list/','BookController@bookList')->name('admin.book_list');
	Route::get('ajax/list/','BookController@ajaxBookList')->name('admin.ajax_book_list');

	Route::get('orders/','BookController@bookOrderList')->name('admin.book_order_list');
	Route::get('orders/ajax','BookController@bookOrderAjaxList')->name('admin.book_order_ajax_list');
	Route::get('Order/Detail/{order_id}','BookController@bookOrderDetail')->name('admin.book_order_detail');

});

Route::group(['namespace' => 'Order', 'prefix' => 'Order'],function(){
	Route::get('Status/Update/{order_id}/{status}','OrderController@bookOrderStatus')->name('admin.book_order_status');
	Route::get('Dispatch/Form/{order_id}','OrderController@BookOrderDispatchedForm')->name('admin.book_order_dispatch_form');
	Route::post('Dispatch/Submit','OrderController@BookOrderDispatched')->name('admin.book_order_dispatch');

	/** Project Orders **/
	Route::get('project/','OrderController@projectOrderList')->name('admin.project_order_list');
	Route::get('project/ajax','OrderController@projectOrderAjaxList')->name('admin.project_order_ajax_list');

	/** Megazine Orders **/
	Route::get('megazine/','OrderController@megazineOrderList')->name('admin.megazine_order_list');
	Route::get('megazine/ajax','OrderController@megazineOrderAjaxList')->name('admin.megazine_order_ajax_list');
});

Route::group(['namespace'=> 'Quiz','prefix'=>'Quiz'], function(){

	Route::get('Add/','QuizController@addQuizForm')->name('admin.add_new_quiz_form');
	Route::post('insert/','QuizController@addQuiz')->name('admin.insert_new_quiz');
	Route::get('Edit/{quiz_id}','QuizController@editQuizForm')->name('admin.edit_quiz_form');
	Route::post('update/','QuizController@updateQuiz')->name('admin.update_quiz');
	Route::get('Status/Update/{quiz_id}/{status}','QuizController@quizStatusUpdate')->name('admin.quiz_status_update');
	Route::get('Approve/{quiz_id}/{status}','QuizController@quizApprove')->name('admin.quiz_approve');

	Route::get('Detail/View/{quiz_id}','QuizController@quizDetailView')->name('admin.quiz_detail_view');
	Route::get('Download/file/{quiz_id}','QuizController@quizFileDownload')->name('admin.quiz_file_download')->middleware('fileAuthorization');


	Route::get('list/','QuizController@quizList')->name('admin.quiz_list');
	Route::get('ajax/list/','QuizController@ajaxQuizList')->name('admin.ajax_quiz_list');
});

Route::group(['namespace'=> 'Projects','prefix'=>'Project'], function(){

	Route::get('Add/','ProjectController@addProjectForm')->name('admin.add_new_project');
	Route::post('insert/','ProjectController@addProject')->name('admin.insert_new_project');
	Route::get('Edit/{project_id}','ProjectController@editProjectForm')->name('admin.edit_project_form');
	Route::post('update/','ProjectController@projectUpdate')->name('admin.project_update');
	Route::get('Detail/View/{project_id}','ProjectController@projectDetailView')->name('admin.project_detail_view');
	Route::get('preview_file_view/{file_name}', 'ProjectController@previewFileView')->name('preview_file_view');
	Route::get('documentation_file_view/{file_name}', 'ProjectController@documentationFileView')->name('documentation_file_view');
	Route::get('synopsis_file_view/{file_name}', 'ProjectController@synopsisFileView')->name('synopsis_file_view');
	Route::get('Status/Update/{project_id}/{status}','ProjectController@projectStatusUpdate')->name('admin.project_status_update');
	Route::get('Approve/{project_id}/{status}','ProjectController@projectApprove')->name('admin.project_approve');

	Route::get('list/','ProjectController@projectList')->name('admin.project_list');
	Route::get('ajax/list/','ProjectController@ajaxProjectList')->name('admin.ajax_project_list');

});

Route::group(['namespace'=> 'Megazines','prefix'=>'Megazine'], function(){

	Route::get('Add/','MegazineController@addMegazineForm')->name('admin.add_new_megazine');
	Route::post('insert/','MegazineController@addMegazine')->name('admin.insert_new_megazine');
	Route::get('Edit/{megazine_id}','MegazineController@editMegazineForm')->name('admin.edit_megazine_form');
	Route::post('update/','MegazineController@megazineUpdate')->name('admin.megazine_update');
	Route::get('Detail/View/{megazine_id}','MegazineController@megazineDetailView')->name('admin.megazine_detail_view');
	Route::get('cover_image_view/{file_name}', 'MegazineController@coverImageView')->name('cover_image_view');
	Route::get('megazine_file_view/{file_name}', 'MegazineController@megazineFileView')->name('megazine_file_view');
	Route::get('Status/Update/{megazine_id}/{status}','MegazineController@megazineStatusUpdate')->name('admin.megazine_status_update');

	Route::get('Approve/{megazine_id}/{status}','MegazineController@megazineApprove')->name('admin.megazine_approve');

	Route::get('list/','MegazineController@megazineList')->name('admin.megazine_list');
	Route::get('ajax/list/','MegazineController@ajaxMegazineList')->name('admin.ajax_megazine_list');
});

Route::group(['namespace' => 'Order'],function(){
	
});