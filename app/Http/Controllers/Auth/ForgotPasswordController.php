<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\SendMailRequest;
use App\Jobs\SendEmailResetPassword;
use App\Models\User;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return view('auth.forget-password');
    }

    public function sendMail(SendMailRequest $request)
    {
        $email = $request->email;
        $token = uniqid();
        $url = route('forgetPassword.reset') . '?token=' . $token;
        $dataReset = [
            'url' => $url,
            'email' => $email,
        ];
        SendEmailResetPassword::dispatch($dataReset);
        if (Cache::has('reset-password') || Cache::get('reset-password') == null) {
            Artisan::call('cache:clear');
        }
        $data = [
            'token' => bcrypt($token),
            'email' => $email,
        ];
        Cache::put('reset-password', $data, 600);
        $request->session()->flash('success', __('messages.Send_reset_email_successfully'));

        return redirect(route('home'));
    }

    public function reset(Request $request)
    {
        if (!isset($_GET['token']) || !Cache::get('reset-password')) {
            $request->session()->flash('error', __('messages.Reset-password-fail'));

            return redirect(route('home'));
        }

        if (!Hash::check($_GET['token'], Cache::get('reset-password')['token'])) {
            $request->session()->flash('error', __('messages.Reset-password-fail'));


            return redirect(route('home'));
        }
        $email = Cache::get('reset-password')['email'];
        $data = compact(
            'email'
        );

        return view('auth.reset-password-form', $data);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $data = $request->except('_token');
        $user = $this->userRepository->where('email', '=', $data['email'])->where('is_active', User::ACTIVE)->first();

        if (is_null($user)) {
            $request->session()->flash('error', __('messages.user-not-found'));

            return redirect(route('home'));
        }

        $this->userRepository->resetPassword($user, $data['password']);
        $request->session()->flash('success', __('messages.reset-password-success'));

        return redirect(route('home'));
    }
}
