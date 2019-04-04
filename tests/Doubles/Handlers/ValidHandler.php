<?php

namespace Tests\Doubles\Handlers;

use SoapBox\Webhooks\Store;
use SoapBox\Webhooks\WebhookHandler;

class ValidHandler implements WebhookHandler
{
    public static $called = false;

    public function handle(Store $request): void
    {
        static::$called = true;
    }
}
