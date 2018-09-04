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

Route::get('/', function () {
    auth ()->login (\App\User::first());
    $user = auth ()->user ()->load('token');
    if(empty($user->token)){
        $token = New \App\UserToken();
        $token->user_id = $user->id;
        $token->token = \Illuminate\Support\Str::random (120);
        $token->save ();
        $user = auth ()->user ()->load('token');
    }
    return response ()->json (['result'=>[
        'name'=>$user->name,
        'family'=>$user->family,
        'email'=>$user->email,
        'token'=>$user->token->token,
        'username'=>$user->username
    ],'status'=>200]);
});
