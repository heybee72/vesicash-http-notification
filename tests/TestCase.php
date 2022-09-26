<?php

namespace Tests;

use App\Models\Topic;
use Database\Factories\TopicFactory;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function createTopic()
    {
        $topic = Topic::factory()->create();
        return $topic;
    }
}
