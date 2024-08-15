<?php

namespace App\Providers;

use App\Models\EmailConfiguration;
use App\Models\GeneralSetting;
use App\Models\LogoSetting;

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
        $logoSetting = LogoSetting::first();
        $mailSetting = EmailConfiguration::first();
        /** set time zone */
        Config::set('app.timezone', $generalSetting->time_zone);

        /** Set Mail Config */
        Config::set('mail.mailers.smtp.host', $mailSetting->host);
        Config::set('mail.mailers.smtp.port', $mailSetting->port);
        Config::set('mail.mailers.smtp.encryption', $mailSetting->encryption);
        Config::set('mail.mailers.smtp.username', $mailSetting->username);
        Config::set('mail.mailers.smtp.password', $mailSetting->password);
        
        /** Share variable at all view */

        View::composer('*', function ($view) use ($generalSetting, $logoSetting) {
            $view->with(['settings' => $generalSetting, 'logoSetting' => $logoSetting]);
        });
    }
}
