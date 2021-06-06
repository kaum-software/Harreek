<?php

namespace Kaum\Harreek\Abstracts\Providers;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

abstract class BaseAppServiceProvider extends LaravelServiceProvider
{
    public function boot(): void {
        // Nothing
    }

    public function register()
    {
        // Nothing
    }
}