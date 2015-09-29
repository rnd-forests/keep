<?php

namespace Keep\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;

class Notification extends Model implements SluggableInterface
{
    use SluggableTrait;

    protected $dates = ['sent_at'];
    protected $attachedObject = null;
    protected $sluggable = ['build_from' => 'subject', 'save_to' => 'slug'];
    protected $fillable = [
        'sent_from', 'type', 'subject', 'slug', 'body',
        'object_id', 'object_type', 'sent_at',
    ];

    /**
     * Users associated with a notification.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function users()
    {
        return $this->morphedByMany(User::class, 'notifiable');
    }

    /**
     * Groups associated with a notification.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function groups()
    {
        return $this->morphedByMany(Group::class, 'notifiable');
    }

    /**
     * Old notification query scope.
     *
     * @param $query
     * @return mixed
     */
    public function scopeOld($query)
    {
        return $query->where('sent_at', '<=', Carbon::now()->subDays(10));
    }

    /**
     * The object attached to the notification.
     *
     * @return mixed|null
     */
    public function getObject()
    {
        $this->attachedObject = call_user_func_array(
            $this->object_type . '::findOrFail',
            [$this->object_id]
        );

        return $this->attachedObject;
    }

    /**
     * Set the route key.
     *
     * @return string
     */
    public function getRouteKey()
    {
        return $this->slug;
    }
}
