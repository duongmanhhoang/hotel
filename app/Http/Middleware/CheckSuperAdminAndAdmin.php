<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckSuperAdminAndAdmin
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
        $user = Auth::user();
        if ($user->role_id == Role::SUPER_ADMIN || $user->role_id == Role::ADMIN) {
            return $next($request);
        } else {
            abort(403);
        }
    }
}
