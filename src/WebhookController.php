<?php

namespace SoapBox\Webhooks;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class WebhookController extends Controller
{
    /**
     * Handle a webhook request from the API
     *
     * @param Store $request
     *
     * @return \Illuminate\Http\Response
     */
    public function handle(Store $request): Response
    {
        $class = $this->getClass($request);

        if (class_exists($class)) {
            (new $class)->handle($request);
        }

        return new Response([], Response::HTTP_OK);
    }

    /**
     * Get the namespace for the class that should handle the request
     *
     * @param Store $request
     *
     * @return string
     */
    private function getClass(Store $request): string
    {
        return config('webhooks.handler_namespace') . "\\" . studly_case(str_replace('.', '_', $request->getEventType()));
    }
}
