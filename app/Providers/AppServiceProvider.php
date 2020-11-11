<?php

namespace App\Providers;

use App\Services\OrderService;
use App\Services\PaymentVerificationService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PaymentVerificationService::class, function ($app) {
            return new PaymentVerificationService();
        });

        $this->app->singleton(OrderService::class, function ($app) {
            return new OrderService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // * This code change migrations path to migrations/*
        $mainPath = database_path('migrations');
        $directories = glob($mainPath . "/*", GLOB_ONLYDIR);
        $paths = array_merge([$mainPath], $directories);

        $this->loadMigrationsFrom($paths);
    }
}
