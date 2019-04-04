<?php

namespace Tests\Doubles\Handlers;

use stdClass;
use SoapBox\Webhooks\Store;
use SoapBox\Webhooks\WebhookHandler;

class ConstructorDependencyHandler implements WebhookHandler
{
    public static $called = false;
    private $classDependency;

    public function __construct(stdClass $classDependency)
    {
        $this->classDependency = $classDependency;
    }

    public function handle(Store $request): void
    {
        static::$called = true;
    }
}
