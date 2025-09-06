<?php

namespace Wapilot\SDK;

use Illuminate\Support\ServiceProvider;

class WapilotServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/wapilot.php' => config_path('wapilot.php'),
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/wapilot.php', 'wapilot');

        $this->app->singleton(WapilotSDK::class, function ($app) {
            return new WapilotSDK(
                config('wapilot.token'),
                config('wapilot.base_url', 'https://app.wapilot.io')
            );
        });

        $this->app->alias(WapilotSDK::class, 'wapilot');
    }
}
