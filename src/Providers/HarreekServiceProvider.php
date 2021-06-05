<?php

namespace Kaum\Harreek\Providers;

use Kaum\Harreek\Facade\Harreek;

class HarreekServiceProvider extends \ServiceProvider
{
   public function boot(): void
   {
       parent::boot();

       if ($this->app->runningInConsole()) {
           $this->publishes([
               __DIR__ . '/../config/config.php' => config_path('harreek.php'),
           ], 'config');
       }

       // Fix "Specified key was too long" exception that Laravel throws in 5.4+
       \Schema::defaultStringLength(191);
   }

    /**
     * Register the application services.
     */
    public function register()
    {
        parent::register();

        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'harreek');

        // Register the main class to use with the facade
        $this->app->singleton('harreek', function () {
            return new Harreek;
        });
    }
}
