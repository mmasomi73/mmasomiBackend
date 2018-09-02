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
//
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/v1/posts',"Api\V1\PostController@posts")->name ('api.v1.posts.index');
Route::any('/v1/posts/store',"Api\V1\PostController@postStore")->name ('api.v1.posts.store');