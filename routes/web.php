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

Route::group(['domain' => 'admin.'.env('APP_DOMAIN')],function () {
	Route::get('login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login.form');
	Route::post('login', 'Admin\Auth\LoginController@login')->name('admin.login');
	Route::get('logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');
});
