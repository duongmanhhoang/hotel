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
        if (Auth::check() || Cookie::get('remember_token')) {
            return redirect()->back();
        }

        return view('auth.login');
    }

    public function submitLogin(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            if ($request->remember == 'on') {
                $minutes = 50000;
                $cookie_data = [];
                $cookie_data['remember_token'] = $user->remember_token;
                $cookie_data['id'] = $user->id;
                Cookie::queue(Cookie::make('remember_token', json_encode($cookie_data), $minutes));
            }
            if ($user->role_id == config('common.roles.member')) {
                return redirect(route('client.index'));
            } else {
                return redirect(route('admin.index'));
            }
        } else {
            $request->session()->flash('errors');

            return redirect(route('client.login'));
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
