<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo ;

    protected function credentials(Request $request)
    {
        return array_merge(
            $request->only($this->username(), 'password'),
            ["confirmation_token"=>null],
            ['active'=>1]
        );
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
           
        if (Auth::check() && Auth::user()->role->id== 2)
        {
            $this->redirectTo = route('admin.dashboard');
        }  

         

        else{
            $this->redirectTo = '/';
        }

        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user){

        if (Auth::check() && Auth::user()->role->id== 2  )
        {
            $this->redirectTo = route('admin.dashboard');
        }
        elseif(Auth::user()->profile()->pluck('type')[0]=='acheteur'){
            $this->redirectTo = '/myposts';
        } 

        else{
            $this->redirectTo = '/';
        }
    }
}
