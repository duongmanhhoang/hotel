<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        View::composer(['admin.layouts.header'], function ($view) {
            if (Auth::check()) {
                $admin = Auth::user();
            } elseif (Cookie::get('remember_token')) {
                $remember_token = json_decode(Cookie::get('remember_token'));
                $admin = User::find($remember_token->id);
            }
            $view->with('admin', $admin);
        });
    }
}
