<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
    protected $redirectTo = '/home';
    
    /**
     * Determine where to redirect users after login based on their role
     */
    protected function redirectTo()
    {
        // Check if there's an intended URL (e.g., from live-results page)
        if (session()->has('intended_url')) {
            return session('intended_url');
        }
        
        if (auth()->check()) {
            $user = auth()->user();
            if ($user->role === 'admin') {
                return '/admin/dashboard';
            } elseif ($user->role === 'trader') {
                return '/progress';
            }
        }
        return '/home';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Handle a login request to the application.
     * Override to use dynamic remember duration from site settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(\Illuminate\Http\Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Send the response after the user was authenticated.
     * Override to use dynamic remember duration.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendLoginResponse(\Illuminate\Http\Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        // Get dynamic remember duration from site settings
        $setting = \App\Models\SiteSetting::first();
        $days = $setting->remember_me_duration_days ?? 30;
        $minutes = $days * 24 * 60; // Convert days to minutes

        // Check for intended URL (from live-results or other pages)
        $intendedUrl = $request->session()->get('intended_url');
        $redirectTo = $intendedUrl ? $intendedUrl : $this->redirectPath();
        
        // Clear intended URL after use
        if ($intendedUrl) {
            $request->session()->forget('intended_url');
        }

        // If remember me is checked, set custom cookie expiration
        if ($request->filled('remember')) {
            $rememberToken = $this->guard()->user()->getRememberToken();
            if ($rememberToken) {
                $cookie = cookie(
                    $this->guard()->getRecallerName(),
                    $this->guard()->user()->id . '|' . $rememberToken . '|' . $this->guard()->user()->password,
                    $minutes
                );
                return redirect($redirectTo)->withCookie($cookie);
            }
        }

        return $request->wantsJson()
                    ? new \Illuminate\Http\JsonResponse([], 204)
                    : redirect($redirectTo);
    }
}
