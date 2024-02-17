<?php

namespace NotificationChannels\TouchSms;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use TouchSms\ApiClient\Client;
use TouchSms\ApiClient\ClientFactory;

class TouchSmsServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the application services.
     */
    public function register(): void
    {
        $this->app->when(TouchSmsChannel::class)
            ->needs(Client::class)
            ->give(function ($app) {
                if (empty($app['config']['services.touchsms.token_id'])
                    || empty($app['config']['services.touchsms.access_token'])) {
                    throw new \InvalidArgumentException('Missing TouchSMS config in services');
                }

                return ClientFactory::create(
                    $app['config']['services.touchsms.access_token'],
                    $app['config']['services.touchsms.token_id']
                );
            });
    }
}
