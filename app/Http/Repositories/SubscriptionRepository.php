<?php

namespace App\Http\Repositories;

use Exception;
use App\Models\Topic;
use App\Models\Subscription;
use App\Traits\JsonResponse;
use App\Http\Requests\SubscriptionRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SubscriptionRepository
{
    use JsonResponse;

    /**
     * Create a subscription.
     *
     * @param \App\Http\Requests\SubscriptionRequest $request
     * @param \App\Models\Topic $topic_name
     * 
     *@return \App\Models\Subscription
     */

    public function createSubscription(SubscriptionRequest $request, $topic_name)
    {
        try {
            $url = $request->url;
            $topic = Topic::where('name', $topic_name)->first();

            if (!$topic) {

                $topic = Topic::create([
                    'name' => $topic_name
                ]);
            }

            $subscription = Subscription::create([
                'topic_id' => $topic->id,
                'url' => $url
            ]);

            return $subscription->format();
        } catch (Exception $exception) {

            throw new HttpException(503, 'Unable to subscribe', $exception);
        }
    }
}
