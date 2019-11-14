<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\RegisterRequest;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class UserController extends Controller
{
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepo = $userRepository;
    }

    public function register(RegisterRequest $request)
    {
        $input = $request->all();

        $input['role_id'] = $this->userRepo::MEMBER_ROLE;

        $this->userRepo->clientRegister($input);

        return response()->json([
            'status' => 'success',
            'message' => __('messages.user.register_success'),
        ]);
    }

    public function activeUser(Request $request)
    {
        $tokenToActive = $request->input('token') ?? null;

        $cookieActiveToken = json_decode(Cookie::get('active_token'));

        if($tokenToActive != null && $tokenToActive == $cookieActiveToken->token) {

            $user = $this->userRepo->find($cookieActiveToken->userId);

            if($user->is_active == $this->userRepo::ACTIVE) {
                return redirect()->route('home')->with(['error' => __('messages.user.already_active')]);
            }

            $this->userRepo->activeUser($user);

            return redirect()->route('home')->with(['success' => __('messages.user.active_success')]);
        }

        return redirect()->route('home')->with(['success' => __('messages.user.expire_token')]);
    }

    public function resendActive(Request $request)
    {
        $input = $request->all();

        $user = $this->userRepo->findUserViaEmail($input['email']);

        if($user == null) {
            return redirect()->back()->with(['error' => __('messages.user.not_found')]);
        }

        $input['full_name'] = $user->full_name;

        $this->userRepo->sendMailActive($input);

        return redirect()->back()->with(['success' => __('messages.user.resend_active_email')]);

    }
}
