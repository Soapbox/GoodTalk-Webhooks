<?php

namespace Tests;

use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use Illuminate\Config\Repository;
use Illuminate\Support\Facades\Route;
use SoapBox\SignedRequests\Signature;
use Orchestra\Testbench\TestCase as BaseTestCase;
use SoapBox\SignedRequests\Middlewares\Laravel\VerifySignature;

class HttpTestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            'SoapBox\Webhooks\WebhookServiceProvider'
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('signed-requests', [
            'webhooks' => [
                'headers' => [
                    'algorithm' => 'GoodTalk-Algorithm',
                    'signature' => 'GoodTalk-Signature',
                ],
                'algorithm' => 'sha512',
                'key' => 'testkey',
                'request-replay' => [
                    'allow' => false,
                    'tolerance' => 30
                ]
            ]
        ]);

        $app['config']->set('webhooks', [
            'handler_namespace' => "Tests\\Doubles\\Handlers"
        ]);

        Route::aliasMiddleware('verify-signature', VerifySignature::class);
    }

    public function signedJson($method, $uri, array $data = [], array $headers = [], $requestKey = 'default')
    {
        $config = $this->app->make(Repository::class);

        $algorithmHeader = $config->get("signed-requests.$requestKey.headers.algorithm");
        $signatureHeader = $config->get("signed-requests.$requestKey.headers.signature");

        $algorithm = $config->get("signed-requests.$requestKey.algorithm");
        $key = $config->get("signed-requests.$requestKey.key");

        $id = (string) Uuid::uuid4();
        $timestamp = (string) Carbon::now();

        $payload = json_encode([
            'id' => $id,
            'method' => $method,
            'timestamp' => $timestamp,
            'uri' => $this->prepareUrlForRequest($uri),
            'content' => json_encode($data, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE),
        ], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        $signature = new Signature($payload, $algorithm, $key);

        $headers = array_merge([
            'HTTP_X-SIGNED-ID' => $id,
            'HTTP_X-SIGNED-TIMESTAMP' => $timestamp,
            'HTTP_' . $algorithmHeader => (string) $algorithm,
            'HTTP_' . $signatureHeader => (string) $signature,
        ], $headers);

        return parent::json($method, $uri, $data, $headers);
    }
}
