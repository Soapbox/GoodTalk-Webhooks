<?php

namespace SoapBox\Webhooks;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class WebhookController extends Controller
{
    public function handle(Store $request): Response
    {
        if (!$request->isValid()) {
            return new Response([], 422);
        }

        $class = $this->getClass($request);

        if (class_exists($class)) {
            (new $class)->handle($request);
        }

        return new Response([], 200);
    }

    private function getClass(Store $request): string
    {
        return config('webhooks.handler_namespace') . "\\" . studly_case(str_replace('.', '_', $request->getEventType()));
    }
}
