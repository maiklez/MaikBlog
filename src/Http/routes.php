<?php

Route::group(['middleware' => 'web'], function () {
	
	Route::get('blog', 'MaikBlogController@index')->name('blog');
	
	Route::get('blog2', 'MaikBlogController@index')->middleware(['auth']);
	
	Route::resource('post', 'MaikBlogController', ['only' => [
			'create', 'show','store', 'edit', 'update', 'destroy'
	], 'middleware' =>['auth']]);
	
	Route::post('post/{id}/addComment', 'MaikBlogController@addComment')->name('add_comment')->middleware(['auth']);
	
});
	