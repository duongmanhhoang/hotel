<?php

namespace App\Repositories\Role;

use App\Models\Role;
use App\Repositories\EloquentRepository;

class RoleRepository extends EloquentRepository
{
    public function getModel()
    {
        return Role::class;
    }

    public function getRoles()
    {
        return $this->_model->whereNotIn('id', [Role::ADMIN, Role::SUPER_ADMIN])->orderBy('id', 'desc')->get();
    }

    public function deleteRole($id)
    {
        $this->delete($id);
    }

}
