<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Roles\StoreRequest;
use App\Http\Requests\Admin\Roles\UpdateRequest;
use App\Repositories\Role\RoleRepository;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        $roles = $this->roleRepository->getRoles();
        $data = compact(
            'roles'
        );

        return view('admin.roles.index', $data);
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->except('_token');
        $this->roleRepository->create($data);
        $request->session()->flash('success', 'Thêm thành công');

        return redirect(route('admin.roles.index'));
    }

    public function edit($id)
    {
        $role = $this->roleRepository->findOrFail($id);
        $data = compact(
            'role'
        );

        return view('admin.roles.edit', $data);
    }

    public function update(UpdateRequest $request, $id)
    {
        $data = $request->except('_token');
        $this->roleRepository->update($id, $data);
        $request->session()->flash('success', 'Sửa thành công');

        return redirect()->back();
    }

    public function delete(Request $request, $id)
    {
        $delete = $this->roleRepository->deleteRole($id);

        if ($delete) {
            $request->session()->flash('success', 'Xóa thành công');
        } else {
            $request->session()->flash('error', 'Quyền này đang được sử dụng');
        }

        return redirect()->back();
    }
}
