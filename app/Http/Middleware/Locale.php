<?php

namespace App\Http\Middleware;

use App\Models\Language;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class Locale
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
        $base = Language::find(config('common.languages.default'));
        if(!Session::has('locale')){
            Session::put('locale', $base->id);
        }
        $language = Language::find(Session::get('locale'));
        App::setLocale($language->short);

        return $next($request);
    }
}
