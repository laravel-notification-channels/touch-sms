<?php

namespace NotificationChannels\TouchSms;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use TouchSMS\TouchSMS\touchSMS;

class TouchSmsServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton(touchSMS::class, function ($app) {
            if (empty($app['config']['services.touchsms.token_id'])
                || empty($app['config']['services.touchsms.access_token'])) {
                throw new \InvalidArgumentException('Missing TouchSMS config in services');
            }

            return new touchSMS(
                $app['config']['services.touchsms.token_id'],
                $app['config']['services.touchsms.access_token'],
                $app['config']['services.touchsms.sandbox'] ?? false
            );
        });
    }

    public function provides()
    {
        return [touchSMS::class];
    }
}
