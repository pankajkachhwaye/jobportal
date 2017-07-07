<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Auth;
use App\User;


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
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


//    protected function validateLogin(Request $request)
//    {
//        $this->validate($request, [$this->username() => 'required', 'password' => 'required',]);
//    }
//
//    public function login(Request $request)
//    {
//        $this->validateLogin($request);
//        $user = User::whereEmail($request->email)->first();
//        $userVerified = User::select('verified')->whereEmail($request->email)->first();
//        if (!$user) {
//            return redirect('login')->withErrors(['mailnotexist' => Lang::get('auth.mailError')]);
//        }
//        if ($userVerified->verified == false) {
//            return redirect('login')->withErrors(['notverify' => Lang::get('auth.verifyerror')]);
//        }
//        if ($this->hasTooManyLoginAttempts($request)) {
//            $this->fireLockoutEvent($request);
//            return $this->sendLockoutResponse($request);
//        }
//        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'verified' => 1])) {
//            // Authentication passed...
//            return redirect()->intended('user-dashboard');
//        } else {
//            return redirect('login')->withErrors(['invalid' => Lang::get('auth.failed')]);
//        }
//    }
}
