<?php

namespace App\Providers;

use Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //get route of current page
        $currentPath = Request::path();
        $values = explode("/", $currentPath);
        $currentRoute = $values[0];
        view()->share('currentRoute', $currentRoute);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }
}
