<?php

Route::group(['domain' => 'admin.'.env('APP_DOMAIN')],function () {
	//----------------------------------------= Profile
	Route::get('/','IndexController@index')->name('admin.index');
	Route::get('/profile','IndexController@profile')->name('admin.profile');
	Route::post('/profile/update','IndexController@update')->name('admin.profile.update');
	Route::post('/profile/password','IndexController@password')->name('admin.profile.password');

//----------------------------------------= Musics
	Route::get('/musics','MusicController@index')->name('admin.music');
	Route::post('/musics/add','MusicController@create')->name('admin.music.add');
	Route::get('/musics/edit/{music}','MusicController@edit')->name('admin.music.edit');
	Route::post('/musics/update/{music}','MusicController@update')->name('admin.music.update');
	Route::post('/musics/delete/{music}','MusicController@delete')->name('admin.music.delete');
	Route::post('/musics/repost/{music}','MusicController@repost')->name('admin.music.repost');

//----------------------------------------= Posts
	Route::group (['prefix'=>'/posts'],function (){
		Route::get ('/','PostController@index')->name ('admin.posts');
		Route::post('/submit','PostController@add')->name ('admin.posts.add');

		Route::get('/{$post}','PostController@edit')->name ('admin.posts.edit');
		Route::post('/{$post}/submit','PostController@update')->name ('admin.posts.update');

		Route::post('/{$post}/delete','PostController@delete')->name ('admin.posts.delete');
	});
});

