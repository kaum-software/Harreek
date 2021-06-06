<?php


namespace Kaum\Harreek\Abstracts\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as LaravelAuthServiceProvider;

abstract class BaseAuthServiceProvider extends LaravelAuthServiceProvider
{
    public function boot(): void {
        $this->registerPolicies();
    }
}