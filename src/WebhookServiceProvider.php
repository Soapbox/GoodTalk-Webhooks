<?php

namespace SoapBox\Webhooks;

use Illuminate\Support\ServiceProvider;

class WebhookServiceProvider extends ServiceProvider
{
    public function boot()
    {
        include __DIR__. '/routes.php';

        $this->publishes([
            __DIR__ . '/../config/webhooks.php' => config_path('webhooks.php')
        ]);
    }

    public function register()
    {
        $this->app->make('SoapBox\Webhooks\WebhookController');

        $this->mergeConfigFrom(__DIR__ . '/../config/signed-requests.php', 'signed-requests');
    }
}
