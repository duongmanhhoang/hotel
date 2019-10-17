<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Role\RoleRepository;
use App\Repositories\Route\RouteRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RouteController extends Controller
{
    public function __construct(RouteRepository $routeRepository, RoleRepository $roleRepository)
    {
        $this->routeRepository = $routeRepository;
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        DB::beginTransaction();
        try {
            $count = $this->routeRepository->autoUpdateRoles();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $count = 'error';
        }

        $routes = $this->routeRepository->paginate(config('common.pagination.default'));
        $roles = $this->roleRepository->getRoles();

        foreach ($routes as $route) {
            $access = $route->roles;
            $array = [];
            foreach ($access as $item) {
                $array[] = $item->id;
            }
            $route->getPermission = $array;
        }

        $data = compact(
            'count',
            'routes',
            'roles'
        );

        return view('admin.routes.index', $data);
    }
}
