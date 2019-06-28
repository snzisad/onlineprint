<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Redirect;

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

    public function showLoginForm()
    {
        return Redirect::route('home');;
    }

    public function login(Request $request){
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
         ]);

         if(Auth::guard()->attempt([
            'email'=>$request->email,
            'password'=>$request->password,
            // 'type' => 0
        ])){
            if(Auth::user()->status == 0){
                $uid = Auth::user()->id;
                Auth::logout();
                return Redirect::route('showVerifyForm', ['id'=>$uid]);
            }
            else{
                return Redirect::route('new_order');
            }
        }
        else{
            throw ValidationException::withMessages([
                $this->username() => [trans('auth.failed')],
            ]);
        }

    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

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
