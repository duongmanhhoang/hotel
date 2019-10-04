<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Repositories\User\UserRepository;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

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

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login()
    {
        if (Auth::check()) {
            return redirect()->back();
        }

        return view('auth.login');
    }

    public function submitLogin(LoginRequest $request)
    {
        $remember = false;
        if ($request->remember == 'on') {
            $remember = true;
        }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_active' => 1], $remember)) {
            $user = Auth::user();
            if ($user->role_id == config('common.roles.member')) {
                return redirect(route('index'));
            } else {
                return redirect(route('admin.index'));
            }
        } else {
            $request->session()->flash('login-error');

            return redirect(route('login'));
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        Cookie::queue(Cookie::forget('remember_token'));

        return $this->loggedOut($request) ?: redirect('/');
    }
}
