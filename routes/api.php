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
//\App\User::create (['name'=>'ayda','family'=>'naghi bakhsh',
//    'username'=>'onlygod6','email'=>'onlygod6@gmail.com','password'=>bcrypt ('123456'),'status'=>1]);
Route::get('/v1/posts',"Api\V1\PostController@posts")->name ('api.v1.posts.index');
Route::post('/v1/posts/store',"Api\V1\PostController@postStore")->name ('api.v1.posts.store');

//--------------= Authentication
Route::post('/v1/login',"Api\V1\User\Auth\LoginController@login")->name ('api.v1.user.login');
Route::post('/v1/logout',"Api\V1\User\Auth\LoginController@logout")->name ('api.v1.user.logout');