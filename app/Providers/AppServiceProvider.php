<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
use App\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('share_setting', Setting::first());
        User::observe(UserObserver::class);
        app()->singleton('lang',function()
        {
            if(!\session()->has('lang'))
            {
                \session()->put('lang','it');
                app()->setLocale(\session()->has('lang'));
            }
            else
            {
                app()->setLocale(\session()->has('lang'));
            }
        });
    }
}
