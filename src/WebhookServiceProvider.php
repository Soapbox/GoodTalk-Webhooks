<?php

namespace SoapBox\Webhooks;

use Illuminate\Support\ServiceProvider;

class WebhookServiceProvider extends ServiceProvider
{
    public function boot()
    {
        include __DIR__. '/routes.php';
    }

    public function register()
    {

        $this->app->make('SoapBox\Webhooks\WebhookController');
    }
}
