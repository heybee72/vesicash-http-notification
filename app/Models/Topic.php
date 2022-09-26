<?php

namespace App\Models;

use App\Models\Publish;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Topic extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get all of the subscriptions for the Topic
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    /**
     * Get all of the publishes for the Topic
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function publishes(): HasMany
    {
        return $this->hasMany(Publish::class);
    }
}
