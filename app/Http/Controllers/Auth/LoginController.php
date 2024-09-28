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

    public function username()
    {
        return 'identifier';
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    protected function Login(Request $request)
    {
        $loginData = $request->only($this->username(), 'password');
        $identifier = $loginData[$this->username()];

        if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
            $loginType = 'email';
        } elseif (is_numeric($identifier) && strlen($identifier) == 18) {
            $loginType = 'nip';
        } else {
            $loginType = 'nim';
        }

        $credentials = [
            $loginType => $identifier,
            'password' => $loginData['password']
        ];

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $user = Auth::user();

            if ($user->role == 'mahasiswa') {
                return redirect()->route('mahasiswa');
            } elseif ($user->role == 'tendik') {
                return redirect()->route('tendik');
            } elseif ($user->role == 'admin') {
                return redirect()->route('admin');
            } else {
                Auth::logout();
                return redirect('/login')->with('error', 'Unauthorized access detected. Please contact support.');
            }
        } else {
            $errors = ['identifier' => 'Username atau Password salah!', 'password' => 'Username atau Password salah!'];
            return redirect('/login')->withErrors($errors)->withInput();
        }
    }
}
