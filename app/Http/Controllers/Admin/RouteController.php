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

    public function index(Request $request)
    {
        $keyword = $request->keyword;
        DB::beginTransaction();
        try {
            $count = $this->routeRepository->autoUpdateRoles();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $count = 'error';
        }
        if ($keyword) {
            $routes = $this->routeRepository->search('name', $keyword, config('common.pagination.default'));
        } else {
            $routes = $this->routeRepository->paginate(config('common.pagination.default'));
        }

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

    public function store(Request $request)
    {
        $data = $request->all();
        $store = $this->routeRepository->storeData($data);
        if ($store) {
            $dataResponse = [
                'messages' => 'success',
            ];
        } else {
            $dataResponse = [
                'messages' => 'errors',
            ];
        }

        return response()->json($dataResponse, 200);
    }

    public function delete(Request $request)
    {
        $data = $request->all();
        $store = $this->routeRepository->deleteData($data);
        if ($store) {
            $dataResponse = [
                'messages' => 'success',
            ];
        } else {
            $dataResponse = [
                'messages' => 'errors',
            ];
        }

        return response()->json($dataResponse, 200);
    }
}
