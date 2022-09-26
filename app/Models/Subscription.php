<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the topic that owns the Subscription
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    public function format()
    {
        return [
            'url' => $this->url,
            'topic' => $this->topic->name,
        ];
    }

    /**
     * Checks is a topic is already Subscribed.
     *
     * @param string $url
     * @param string $topic
     *
     * @return bool
     */
    public function isSubscribed(string $url, string $topic): ?bool
    {
        $topicResult = Topic::where('name', $topic)->first();
        if ($topicResult) {
            $result = $this->query()->where('topic_id', $topicResult->id)->where('url', $url)->exists();

            return $result;
        }
        return null;
    }
}
