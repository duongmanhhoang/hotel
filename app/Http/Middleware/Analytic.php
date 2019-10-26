<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;

class Analytic
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $redis = Redis::connection();
        $now = date('Y-m-d h:i:s');
        $ip = $request->ip();
        $page = $request->path();
        if ($page != 'login' && $page != 'logout') {
            if (Redis::exists($ip . $page)) {

                return $next($request);
            } else {
                $redis->set($ip . $page, true, 'EX', 10);
                \App\Models\Analytic::create([
                    'time' => $now,
                    'ip' => $ip,
                    'page' => $page
                ]);
            }
        }

        return $next($request);
    }
}
