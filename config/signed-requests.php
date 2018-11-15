<?php

return [
    'webhooks' => [
        'algorithm' => env('WEBHOOKS_SIGNED_REQUEST_ALGORITHM', 'sha256'),
        'cache-prefix' => env('WEBHOOKS_SIGNED_REQUEST_CACHE_PREFIX', 'signed-requests'),
        'headers' => [
            'signature' => env('WEBHOOKS_SIGNED_REQUEST_SIGNATURE_HEADER', 'GoodTalk-Signature'),
            'algorithm' => env('WEBHOOKS_SIGNED_REQUEST_ALGORITHM_HEADER', 'GoodTalk-Signature-Algorithm')
        ],
        'key' => env('WEBHOOKS_SIGNED_REQUEST_KEY', 'key'),
        'request-replay' => [
            'allow' => env('WEBHOOKS_SIGNED_REQUEST_ALLOW_REPLAYS', false),
            'tolerance' => env('WEBHOOKS_SIGNED_REQUEST_TOLERANCE_SECONDS', 30)
        ]
    ]
];
