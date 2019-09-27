<?php

namespace App\Providers;

use App\Models\User;
use App\Models\University;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\Blade;
use App\Observers\UniversityObserver;
use Illuminate\Support\ServiceProvider;
use App\ViewComposers\NavigationComposer;

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
        \Schema::defaultStringLength(191);

        Blade::if('admin', function () {
            return auth()->user()->isAdmin();
        });

        Blade::if('superAdmin', function () {
            return auth()->user()->isSuperAdmin();
        });

        Blade::if('notificationAllowed', function () {
            return general_settings('allow_notifications');
        });

        Blade::if('canViewControlMenu', function () {
            return auth()->user() && ! auth()->user()->isDefaultUser();
        });

        User::observe(UserObserver::class);
        University::observe(UniversityObserver::class);

        view()->composer('layouts.partials.navigation', NavigationComposer::class);
    }
}
