<?php

namespace NotificationChannels\TouchSms;

use Illuminate\Support\ServiceProvider;
use TouchSMS\TouchSMS\touchSMS;

class TouchSmsServiceProvider extends ServiceProvider
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
}
