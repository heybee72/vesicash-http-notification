<?php

namespace App\Events;

use App\Models\Subscription;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PublishTopicEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The subscription instance.
     *
     * @var \App\Models\Subscription
     */
    public $subscriptions;

    /**
     * The publish payload.
     *
     * @var Array
     */
    public $payload;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($subscriptions, $payload)
    {
        $this->subscriptions = $subscriptions;
        $this->payload = $payload;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
