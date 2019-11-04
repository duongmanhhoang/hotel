<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Response;
use Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    public function submitRegister(Request $request) {
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ], 200);
        } else {
            

            $full_name = $request->input('full_name');
            $email = $request->input('email');
            $password = bcrypt($request->input('password'));

            $data = [
                'full_name' => $full_name, 
                'email' => $email,
                'password' => $password,
                'role_id' => config('common.roles.member'),
                'remember_token' => bcrypt(uniqid()),
            ];
            

            // $register = User::create($data);
            $url = 'asdasd';

            $token = time().uniqid(true);
            $minutes = 15;
            $token_cookie = Cookie::queue(Cookie::make('token_cookie', $token, $minutes));
            
            Mail::send('client.email.verify', array('cookie' => Cookie::get('token_cookie'), 'url' => $url), function($message) use ($data) {
            $message->to($data['email'] , $data['full_name'])
                    ->subject('Xác nhận đăng ký');
            });
            
            return response()->json([
                'error' => false,
                'message' => 'success'
            ], 200);


        }
    }

    public function submitVerify($token) {
        dd(Cookie::get('token_cookie'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, 
            [
                'full_name' => ['required', 'string', 'max:191'],
                'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'max:15' ,'confirmed'],
                'password_confirmation' => ['required']
            ],
            [
                'full_name.required' => __('messages.validation.required'),
                'full_name.max' => __('messages.validation.max'),
                
                'email.required' => __('messages.validation.required'),
                'email.email' => __('messages.validation.email'),
                'email.max' => __('messages.validation.max'),
                'email.unique' => __('messages.validation.unique'),

                'password.required' => __('messages.validation.required'),
                'password.min' => __('messages.validation.min', ['number' => ':min']),
                'password.max' => __('messages.validation.max', ['number' => ':max']),
                'password.confirmed' => __('messages.validation.password_confirm'),
                'password_confirmation.required' =>__('messages.validation.required'),
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    // protected function create(array $data)
    // {
    //     return User::create($data);
    // }

}
