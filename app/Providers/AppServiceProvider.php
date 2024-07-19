<?php

namespace App\Providers;

use App\Models\GeneralSetting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        $generalSetting = GeneralSetting::first();
        /** set time zone */
        Config::set('app.timezone', $generalSetting->time_zone);

        /** Share variable at all view */
        View::composer('*', function ($view) use ($generalSetting) {
            $view->with('settings' , $generalSetting);
        });
    }
}
