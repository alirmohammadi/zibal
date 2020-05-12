<?php

namespace Alirmohammadi\Zibal;

use Illuminate\Support\ServiceProvider;

class ZibalServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Alirmohammadi\Zibal\ZibalPayment');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__ . '/routes/routes.php';


        $this->publishes([
            __DIR__.'/config/config.php' => config_path('zibal.php'),
        ]);
    }
}
