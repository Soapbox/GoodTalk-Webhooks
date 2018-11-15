<?php

namespace SoapBox\Webhooks;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class WebhookController extends Controller
{
    public function handle(Store $request): Response
    {
        $class = $this->getClass($request);

        if (class_exists($class)) {
            (new $class)->handle($request);
        }

        return new Response([], 200);
    }

    private function getClass(Store $request): string
    {
        return __NAMESPACE__ . "\\" . studly_case(str_replace('.', '_', $request->getEventType()));
    }
}