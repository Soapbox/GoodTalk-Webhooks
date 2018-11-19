<?php

namespace Tests\Funcitonal;

use Tests\HttpTestCase;
use Illuminate\Http\Response;

class WebhookControllerTest extends HttpTestCase
{
    /**
     * @test
     */
    public function it_should_return_200()
    {
        $data = [
            'event-type' => 'user.updated',
            'data' => [
                'id' => 1
            ]
        ];

        $res = $this->signedJson('POST', '/webhook', $data, [], 'webhooks');

        $this->assertSame(Response::HTTP_OK, $res->getStatusCode());
    }
}
