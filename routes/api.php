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

Route::get('/v1/posts',"Api\V1\PostController@posts")->name ('api.v1.posts.index');
Route::post('/v1/posts/store',"Api\V1\PostController@postStore")->name ('api.v1.posts.store');

Route::get('/v1/musics',"Api\V1\MusicController@musics")->name ('api.v1.musics.index');

//--------------= Authentication
Route::post('/v1/login',"Api\V1\User\Auth\LoginController@login")->name ('api.v1.user.login');
Route::post('/v1/logout',"Api\V1\User\Auth\LoginController@logout")->name ('api.v1.user.logout');