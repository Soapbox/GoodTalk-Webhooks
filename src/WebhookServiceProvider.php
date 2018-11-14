<?php

namespace SoapBox\Webhooks;

use Illuminate\Support\ServiceProvider;

class WebhookServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {

        $this->app->make('SoapBox\Webhooks\WebhookController');
    }
}
