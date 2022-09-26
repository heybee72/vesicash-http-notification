<?php

namespace Tests\Feature\Subscription;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubscriptionTest extends TestCase
{
    use RefreshDatabase,  WithFaker;

    public function testCanSubscribeWithValidPayload()
    {
        $payload = $this->getValidPayload();
        $topic = $this->createTopic();

        $this->post("api/subscribe/{$topic->name}", $payload, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'statusCode',
                'message',
                'data',
            ])
            ->assertJson([
                'message' => 'Subscribed Successfully',
            ]);
    }

    public function testCanNotSubscribeWithInValidPayload()
    {

        $payload = $this->getInvalidValidPayload();
        $topic = $this->createTopic();

        $this->post("api/subscribe/{$topic->name}", $payload, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJsonStructure([
                'status',
                'statusCode',
                'message',
                'data',
            ])
            ->assertJson([
                'message' => 'Validation failed.',
            ]);
    }

    private function getValidPayload()
    {
        return [
            'url' => 'https://www.example.com/test2',
        ];
    }

    private function getInvalidValidPayload()
    {
        return [
            'user' => 'example/test',
        ];
    }
}
