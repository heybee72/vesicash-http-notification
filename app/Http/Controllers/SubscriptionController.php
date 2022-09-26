<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Traits\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Actions\SubscriptionAction;
use App\Http\Requests\SubscriptionRequest;

class SubscriptionController extends Controller
{
    use JsonResponse;

    /**
     * Execute subscription to a topic.
     *
     * @param \App\Http\Requests\SubscriptionRequest $request
     * @param \App\Http\Actions\SubscriptionAction $subscriptionAction
     * @param \App\Models\Subscription $subscription
     * @param \App\Models\Topic $topic
     * 
     * @return \App\Traits\JsonResponse
     */

    public function store(SubscriptionRequest $request, SubscriptionAction $subscriptionAction, Subscription $subscription,  $topic)
    {
        $url = $request->url;

        $isSubscribed = $subscription->isSubscribed($url, $topic);

        if ($isSubscribed) {
            return $this->error('This url is already subscribed to this topic');
        }

        $response = $subscriptionAction->execute($request, $topic);

        return $this->success('Subscribed Successfully', array($response));
    }
}
