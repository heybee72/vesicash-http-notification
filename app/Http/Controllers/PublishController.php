<?php

namespace App\Http\Controllers;

use App\Traits\JsonResponse;
use App\Http\Actions\PublishAction;
use App\Http\Requests\PublishRequest;

class PublishController extends Controller
{
    use JsonResponse;

    /**
     * Publishes a topic.
     *
     * @param \App\Http\Requests\PublishRequest $request
     * @param \App\Http\Actions\PublishAction $publishAction
     * @param \App\Models\Topic $topic
     * 
     *@return \App\Traits\JsonResponse
     */

    public function store(PublishRequest $request, PublishAction $publishAction, $topic)
    {
        
        $response = $publishAction->execute($request, $topic);

        return $this->success('Topic Published Successfully', array($response));
    }
}
