<?php

namespace Keep\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;

class Group extends Model implements SluggableInterface
{
    use SluggableTrait,
        SoftDeletes;

    protected $fillable = ['name', 'slug', 'description'];
    protected $sluggable = ['build_from' => 'name', 'save_to' => 'slug'];

    /**
     * Members of a group.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Notifications of a group.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function notifications()
    {
        return $this->morphToMany(Notification::class, 'notifiable');
    }

    /**
     * Notify a group.
     *
     * @param $notification
     * @return Model
     */
    public function notify($notification)
    {
        return $this->notifications()->save($notification);
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
