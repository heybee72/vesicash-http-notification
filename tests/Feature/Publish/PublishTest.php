<?php

namespace Tests\Feature\Publish;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PublishTest extends TestCase
{
    use RefreshDatabase,  WithFaker;

    public function testCanPublishWithValidPayload()
    {
        $payload = $this->getValidPayload();
        $topic = $this->createTopic();

        $this->post("api/publish/{$topic->name}", $payload, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'statusCode',
                'message',
                'data',
            ])
            ->assertJson([
                'message' => 'Topic Published Successfully',
            ]);
    }

    public function testCanNotPublishWithInValidPayload()
    {
        $payload = $this->getInValidPayload();
        $topic = $this->createTopic();

        $this->post("api/publish/{$topic->name}", $payload, ['Accept' => 'application/json'])
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
            'data' => [
                "msg" => "This is a published message"
            ]
        ];
    }

    private function getInValidPayload()
    {
        return [
            'data' => 'My message'
        ];
    }
}
