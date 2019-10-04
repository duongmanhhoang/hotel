<?php

namespace App\Providers;

use App\Models\Language;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
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
            }
            $view->with('admin', $admin);

            //Current language
            if (Session::get('locale')) {
                $current_language = Language::find(Session::get('locale'));
                if (is_null($current_language)) {
                    $current_language = Language::find(Config::get('common.languages.default'));
                }
            } else {
                $current_language = Language::find(Config::get('common.languages.default'));
            }
            $view->with('current_language', $current_language);

            //List active languages
            $header_languages = Language::where('status', 1)->get();
            $view->with('header_languages', $header_languages);
        });
    }
}
