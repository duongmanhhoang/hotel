<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class AccessRouteByRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $currentRoute = Route::currentRouteName();
        $currentRole = Auth::user()->role_id;
        $route = \App\Models\Route::where('name', $currentRoute)->first();
        if ($currentRole != Role::SUPER_ADMIN || $currentRole != Role::ADMIN) {
            if ($route) {
                $check = $route->roles()->where('roles.id', $currentRole)->first();
                if (!$check) {
                    abort(403);
                }
            }
        }

        return $next($request);
    }
}
