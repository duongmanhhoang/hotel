<?php

namespace App\Repositories\User;

use App\Jobs\SendEmailRegisterJob;
use App\Mail\User\RegiseterMail;
use App\Models\Role;
use App\Models\User;
use App\Repositories\EloquentRepository;
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;

class UserRepository extends EloquentRepository
{

    const MEMBER_ROLE = 4;
    const INACTIVE = 0;
    const ACTIVE = 1;

    public function getModel()
    {
        return User::class;
    }

    public function checkAdmin($role_id)
    {
        $admin = Role::where('name', 'admin')->first();
        if ($admin->id == $role_id) {
            return true;
        } else {
            return false;
        }
    }

    public function getUser()
    {
        if (Auth::check()) {
            $user = Auth::user();
        } elseif (Cookie::get('remember_token')) {
            $remember_token = json_decode(Cookie::get('remember_token'));
            $user = User::find($remember_token->id);
        }

        return $user;
    }

    public function getRoleId($role_name)
    {
        $role = Role::where('name', $role_name)->first();
        if (is_null($role)) {
            return false;
        }
        $id = $role->id;

        return $id;
    }

    public function userNotifi($id)
    {
        $user = User::where('role_id', 1)->get();

        return $user;
    }

    public function checkPermission($id)
    {
        // Role của user được chọn để xóa
        $role_user_selected = User::findOrFail($id)->role_id;
        // Role của user đã đăng nhập vào quản trị
        $role_user_logged = Auth::User()->role_id;
        $status = false;
        if ($role_user_logged == config('common.roles.super_admin')) {
            if ($role_user_selected == config('common.roles.super_admin')) {
                $status = false;
            } else {
                $status = true;
            }
        } else if ($role_user_logged == config('common.roles.admin')) {
            if ($role_user_selected == config('common.roles.super_admin') || $role_user_selected == config('common.roles.admin')) {
                $status = false;
            } else {
                $status = true;
            }
        } else {
            $status = false;
        }
        return $status;
    }

    public function checkAdd()
    {
        // Role của user đã đăng nhập vào quản trị
        $role_user_logged = Auth::User()->role_id;
        $status = false;
        if ($role_user_logged == config('common.roles.super_admin')) {
            $status = true;
        } else if ($role_user_logged == config('common.roles.admin')) {
            $status = true;
        } else {
            $status = false;
        }
        return $status;
    }

    public function checkEdit($id)
    {
        // Role của user được chọn để sửa
        $role_user_selected = User::findOrFail($id)->role_id;
        // Role của user đã đăng nhập vào quản trị
        $role_user_logged = Auth::User()->role_id;
        // Id của user đã đăng nhập vào quản trị
        $id_user_logged = Auth::User()->id;
        // Id của user được chọn để sửa
        $id_user_selected = $id;
        $status = false;
        if ($role_user_logged == config('common.roles.super_admin')) {
            $status = true;
        } else if ($role_user_logged == config('common.roles.admin')) {
            if ($role_user_selected == config('common.roles.super_admin')) {
                $status = false;
            } else if ($role_user_selected == config('common.roles.admin')) {
                if ($role_user_selected == $role_user_logged && $id_user_logged == $id_user_selected) {
                    $status = true;
                } else {
                    $status = false;
                }
            } else {
                $status = true;
            }
        } else {
            if ($role_user_selected == $role_user_logged && $id_user_logged == $id_user_selected) {
                $status = true;
            } else {
                $status = false;
            }

        }
        return $status;
    }

    public function clientRegister($input)
    {
        $input['password'] = Hash::make($input['password']);
        $input['remember_token'] = Hash::make(time());

        $user = $this->_model->create($input);

        $cookie = [
            'userId' => $user->id,
            'token' => $input['remember_token']
        ];

        Cookie::queue('active_token', json_encode($cookie), 7200);

        $this->sendMailActive($input);
    }

    public function activeUser($user)
    {
        $user->update(['is_active' => self::ACTIVE]);
    }

    public function sendMailActive($input)
    {
        $input['remember_token'] = $input['remember_token'] ?? Hash::make(time());

        SendEmailRegisterJob::dispatch($input);
    }

    public function resetPassword($user, $password)
    {
        $password = bcrypt($password);
        $user->password = $password;
        $user->save();
    }
}

