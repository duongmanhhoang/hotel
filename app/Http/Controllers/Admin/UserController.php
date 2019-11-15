<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\StoreRequest;
use App\Http\Requests\Admin\Users\UpdatePasswordRequest;
use App\Http\Requests\Admin\Users\UpdateRequest;
use App\Repositories\Role\RoleRepository;
use App\Repositories\User\UserRepository;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepository;
    protected $roleRepository;

    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    // List users
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        if (!is_null($keyword)) {
            $users = $this->userRepository->search('full_name', $keyword, config('common.pagination.default'));
        } else {
            $users = $this->userRepository->paginate(config('common.pagination.default'));
        }
        return view('admin.users.index', compact('users'));
    }

    // Add new form
    public function create()
    {
        if ($this->userRepository->checkAdd() == true) {
            $roles = $this->roleRepository->where('id', '<>', config('common.roles.super_admin'))->get();
            return view('admin.users.create', compact('roles'));
        } else {
            session()->flash('error', 'Bạn không thể thực hiện hành động này');
            return redirect()->back();
        }
    }

    // Add new users
    public function store(StoreRequest $request)
    {
        $data = $request->except('_token');
        $data['password'] = bcrypt($request->input('password'));
        $data['remember_token'] = bcrypt(uniqid());
        $data['is_active'] = config('common.active.is_active');
        $this->userRepository->create($data);
        $request->session()->flash('success', 'Thêm tài khoản thành công');
        return redirect()->route('admin.users.index');
    }

    // Edit form
    public function edit($id)
    {
        if ($this->userRepository->checkEdit($id) == true) {
            $user = $this->userRepository->findOrFail($id);
            $roles = $this->roleRepository->where('id', '<>', config('common.roles.super_admin'))->get();
            return view('admin.users.edit', compact(['user', 'roles']));
        } else {
            session()->flash('error', 'Bạn không thể thực hiện hành động này');
            return redirect()->back();
        }

    }

    // Edit user
    public function update(UpdateRequest $request, $id)
    {
        $data = $request->except('_token');
        $this->userRepository->update($id, $data);
        $request->session()->flash('success', 'Cập nhật thành công');

        return redirect()->back();
    }

    // Active user
    public function active(Request $request, $id)
    {
        if ($this->userRepository->checkPermission($id) == true) {
            $this->userRepository->update($id, ['is_active' => config('common.active.is_active')]);
            $request->session()->flash('success', 'Kích hoạt thành công');
        } else {
            $request->session()->flash('error', 'Bạn không thể thực hiện hành động này');
        }
        return redirect()->back();
    }

    // Deactive user
    public function deactive(Request $request, $id)
    {
        if ($this->userRepository->checkPermission($id) == true) {
            $this->userRepository->update($id, ['is_active' => config('common.active.not_active')]);
            $request->session()->flash('success', 'Hủy kích hoạt thành công');
        } else {
            $request->session()->flash('error', 'Bạn không thể thực hiện hành động này');
        }
        return redirect()->back();
    }

    // Delete users
    public function delete(Request $request, $id)
    {
        if ($this->userRepository->checkPermission($id) == true) {
            $this->userRepository->delete($id);
            $request->session()->flash('success', 'Xóa thành công');
        } else {
            $request->session()->flash('error', 'Bạn không thể thực hiện hành động này');
        }
        return redirect()->back();
    }

    public function profile()
    {
        $user = Auth::user();

        return view('admin.users.profile', compact('user'));
    }

    public function updateInformation(UpdateRequest $request)
    {
        $input = $request->all();

        $this->userRepository->updateInfo($input);

        return redirect()->back()->with(['success' => 'Cập nhật thành công']);

    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $input = $request->all();

        $updatePassword = $this->userRepository->updatePassword($input);

        if(is_string($updatePassword)) return redirect()->back()->with(['error' => $updatePassword]);

        return redirect()->back()->with(['success' => __('messages.user.password_change_success')]);
    }
}
