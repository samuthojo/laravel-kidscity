<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout', 'cmsLogout',
                                           'showCmsLoginForm', 'cmsLogin');
        $this->middleware('cms_guest')->only('showCmsLoginForm');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function showCmsLoginForm()
    {
        return view('cms.login');
    }

    public function cmsLogin(Request $request)
    {
        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptCmsLogin($request)) {
            return $this->sendCmsLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }


    protected function attemptCmsLogin(Request $request)
    {
        $user = App\User::where($request->only('phone_number'))->first();
        if($user->is_admin) {
          return $this->guard()->attempt(
              $this->credentials($request)
          );
        }
        return false;
    }

    protected function sendCmsLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended('/admin');
    }

    public function username()
    {
        return 'phone_number';
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/login');
    }

    public function cmsLogout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect()->route('cms_login');
    }
}
