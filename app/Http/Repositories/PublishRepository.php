<?php

namespace App\Http\Repositories;

use App\Events\PublishTopicEvent;
use Exception;
use App\Models\Topic;
use App\Models\Subscription;
use App\Traits\JsonResponse;
use App\Http\Requests\PublishRequest;
use App\Models\Publish;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PublishRepository
{
    use JsonResponse;

    /**
     * Publish a topic and dispatch PublishTopic event.
     *
     * @param \App\Http\Requests\PublishRequest $request
     * @param \App\Models\Topic $topic_name
     * 
     *@return array $payload
     */

    public function publishTopic(PublishRequest $request, $topic_name)
    {
        try {
            $data = $request->data;

            $topicID = Topic::where('name', $topic_name)->first()->id;

            //Gets topic's subscribers
            $subscriptions = Subscription::where('topic_id', $topicID)->get();

            $payload = [
                'topic' => $topic_name,
                'data' => $data
            ];

            $savePublish = Publish::create([
                'topic_id' => $topicID,
                'data' => json_encode($data)
            ]);

            if ($savePublish) {

                 PublishTopicEvent::dispatch($subscriptions, $payload);

            }
            return $payload;

        } catch (Exception $exception) {
            return $exception;
            throw new HttpException(503, 'Error occurred Unable to publish topic', $exception);
            // return $exception;
        }
    }
}
