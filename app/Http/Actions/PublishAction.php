<?php

namespace App\Http\Actions;

use App\Http\Requests\PublishRequest;
use App\Http\Repositories\PublishRepository;

class PublishAction
{


    public function __construct(PublishRepository $publishRepository)
    {
        $this->publishRepository = $publishRepository;
    }


    /**
     * Execute publishing a topic.
     *
     * @param \App\Http\Requests\PublishRequest $request
     * @param \App\Models\Topic $topic
     * 
     *@return mixed
     */
    public function execute(PublishRequest $request, $topic)
    {
        $topic_name = $topic;

        $response = $this->publishRepository->publishTopic($request, $topic_name);

        return $response;
    }
}
