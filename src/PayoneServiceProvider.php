<?php

namespace Ideenkonzept\Payone;

use Illuminate\Support\ServiceProvider;

class PayoneServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/payone.php' => config_path('payone.php'),
        ]);

        $this->mergeConfigFrom(
            __DIR__ . '/../config/payone.php', 'payone'
        );

        $this->app->singleton('payone', function ($app) {
            return new Payone;
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }
}
