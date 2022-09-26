<?php

namespace App\Listeners;

use App\Classes\ProcessPublish;
use App\Events\PublishTopicEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifySubscribersListener implements ShouldQueue
{
    /**
     * The number of times the queued listener may be attempted.
     *
     * @var int
     */
    public $tries = 5;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(ProcessPublish $processPublish)
    {
        $this->processPublish = $processPublish;
    }

    /**
     * Handle the event.
     *
     * @param  PublishTopicEvent  $event
     * @return void
     */
    public function handle(PublishTopicEvent $event)
    {
        $this->processPublish->notify($event->subscriptions, $event->payload);
    }
}
