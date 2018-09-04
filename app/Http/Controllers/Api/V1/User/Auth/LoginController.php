<?php

namespace App\Http\Controllers\Api\V1\User\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';


    /**
     * @param Request $request
     * @return string
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);
        if (Auth::attempt($request->only ('username','password'),false)){
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
        }
        else {
            return response (json_encode(['error'=>'Unauthorized','status'=>401]),401);
        }


    }

    public function username()
    {
        return 'username';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
