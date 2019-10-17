<?php

namespace App\Repositories\Route;

use App\Models\Role;
use App\Repositories\EloquentRepository;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class RouteRepository extends EloquentRepository
{
    public function getModel()
    {
        return \App\Models\Route::class;
    }

    public function autoUpdateRoles()
    {
        $routes = Route::getRoutes();
        $count = 0;
        foreach ($routes as $key => $route)
        {
            if (Str::contains($route->getName(),['admin']) && !Str::contains($route->getName(), ['admin.users', 'admin.roles', 'admin.routes', 'admin.languages', 'admin.index'])) {
                $isRoute = $this->_model->where('name',$route->getName())->first();
                if (!$isRoute) {
                    $route = $this->create(['name' => $route->getName()]);
                    $route->roles()->attach([Role::SUPER_ADMIN, Role::ADMIN]);
                    $count++;
                }
            }
        }

        return $count;
    }

    public function storeData($data)
    {
        $route = $this->find($data['id']);
        if (!$route) {
            return false;
        }
        $route->roles()->attach($data['role_id']);

        return true;

    }

    public function deleteData($data)
    {
        $route = $this->find($data['id']);
        if (!$route) {
            return false;
        }
        $route->roles()->detach($data['role_id']);

        return true;
    }
}
