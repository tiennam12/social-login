<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use Cookie;

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
    protected $redirectTo = '/users';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('guest')->except('logout');
//    }

    public function authenticate(Request $request) {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if(Auth::user()->email_verified_at){
                return redirect()->intended('users');
            }   else {
                return redirect()->route('logout')->withErrors('error', 'Opps! You havent verified email');
            }
        }

        return redirect('/')->withErrors('error', 'Opps! You have entered invalid credentials');
    }

    public function login1(Request $request)
    {
        $input = $request->only('email', 'password');
        $token = null;

        if (!$token = JWTAuth::attempt($input)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }
        else if (!$user = auth()->user()->email_verified_at) {
            return response()->json([
                'status' => false,
                'message' => 'Your email havent verified!',
            ], 402 );
        }
        else {
            $user = auth()->user();
            setcookie("jwt_token", $token);
            $tokenDetail = isset($_COOKIE["jwt_token"])?$_COOKIE["jwt_token"]:"";
            $cookies = Cookie::get();

        return response()->json([
            'status' => true,
            'token' => $token,
            'user' => $user,
        ])->withCookie(cookie("jwt_token", $token));}
    }

    public function logout1(Request $request) {
        $request->session()->invalidate();
        $has = Cookie::has('jwt_token');
        Auth::logout();
        setcookie('social',null);
        return redirect('/')->withCookie(Cookie::forget('jwt_token'));
    }
}
