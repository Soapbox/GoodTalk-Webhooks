<?php

namespace SoapBox\Webhooks;

interface WebhookHandler
{
    /**
     * Handle a webhook request from the API
     *
     * @param Store $request
     */
    public function handle(Store $request): void;
}
