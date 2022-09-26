<?php

namespace App\Classes;

use App\Classes\RequestProcessor;

class ProcessPublish
{
    /**
     * Http Request Processor variable
     *
     * @var App\Classes\RequestProcessor $processor
     */
    private $processor;

    public function __construct(RequestProcessor $processor)
    {
        $this->processor = $processor;
    }

    public function notify($subscriptions, $payload)
    {
        foreach ($subscriptions as $subscriber) {

            $url = $subscriber->url;

            $this->processor->setHttpResponse($url, 'POST', array_filter($payload))->getResponse();
        }
        return $payload;
    }
}
