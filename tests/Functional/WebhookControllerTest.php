<?php

namespace Tests\Funcitonal;

use Tests\HttpTestCase;
use Illuminate\Http\Response;
use Tests\Doubles\Handlers\ValidHandler;
use Tests\Doubles\Handlers\MethodDependencyHandler;
use Tests\Doubles\Handlers\DependencyInjectedHandler;
use Tests\Doubles\Handlers\ConstructorDependencyHandler;

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

        $res->assertStatus(Response::HTTP_OK);
    }

    /**
     * @test
     */
    public function it_should_return_422_if_the_event_type_is_not_set()
    {
        $data = [
            'data' => [
                'id' => 1
            ]
        ];

        $res = $this->signedJson('POST', '/webhook', $data, [], 'webhooks');

        $res->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @test
     */
    public function it_should_return_422_if_data_id_is_not_set()
    {
        $data = [
            'event-type' => 'user.updated',
            'data' => [
            ]
        ];

        $res = $this->signedJson('POST', '/webhook', $data, [], 'webhooks');

        $res->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @test
     */
    public function it_should_return_422_if_data_is_not_set()
    {
        $data = [
            'event-type' => 'user.updated',
        ];

        $res = $this->signedJson('POST', '/webhook', $data, [], 'webhooks');

        $res->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @test
     */
    public function is_should_handle_the_request_when_there_is_a_valid_handler()
    {
        $handler = new ValidHandler();
        $data = [
            'event-type' => 'valid.handler',
            'data' => [
                'id' => 1
            ]
        ];

        $res = $this->signedJson('POST', '/webhook', $data, [], 'webhooks');

        $res->assertStatus(Response::HTTP_OK);
        $this->assertTrue($handler::$called);
    }

    /**
     * @test
     */
    public function it_will_resolve_constructor_dependencies_for_the_handler()
    {
        $data = [
            'event-type' => 'constructor.dependency.handler',
            'data' => [
                'id' => 1
            ]
        ];

        $this->withoutExceptionHandling();
        $res = $this->signedJson('POST', '/webhook', $data, [], 'webhooks');

        $res->assertStatus(Response::HTTP_OK);
        $this->assertTrue(ConstructorDependencyHandler::$called);
    }
}
