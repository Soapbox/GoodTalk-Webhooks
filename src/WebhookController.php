<?php

namespace SoapBox\Webhooks;

use Illuminate\Http\Response;
use Illuminate\Contracts\Container\Container;

class WebhookController
{
    /**
     * Handle a webhook request from the API
     *
     * @param \SoapBox\Webhooks\Store $request
     *
     * @return \Illuminate\Http\Response
     */
    public function handle(Store $request, Container $container): Response
    {
        $class = $this->getClass($request);

        if (class_exists($class) && ($handler = $container->make($class)) instanceof WebhookHandler) {
            $handler->handle($request);
        }

        return new Response([], Response::HTTP_OK);
    }

    /**
     * Get the namespace for the class that should handle the request
     *
     * @param \SoapBox\Webhooks\Store $request
     *
     * @return string
     */
    private function getClass(Store $request): string
    {
        return config('webhooks.handler_namespace') . "\\" . studly_case(str_replace('.', '_', $request->getEventType()));
    }
}
