<?php

namespace App\Repositories\Role;

use App\Models\Role;
use App\Models\User;
use App\Repositories\EloquentRepository;

class RoleRepository extends EloquentRepository
{
    public function getModel()
    {
        return Role::class;
    }

    public function getRoles()
    {
        return $this->_model->whereNotIn('id', [Role::ADMIN, Role::SUPER_ADMIN, Role::MEMBER])->orderBy('id', 'desc')->get();
    }

    public function deleteRole($id)
    {
        $check = $this->checkUsers($id);

        if ($check) {
            return false;
        }

        $this->delete($id);

        return true;
    }

    protected function checkUsers($id)
    {
        $count = User::where('role_id', $id)->count();

        if ($count) {
            return true;
        }

        return false;
    }

}
