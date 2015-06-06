<?php
namespace Keep\Entities;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;

class Group extends Model implements SluggableInterface
{
    use SluggableTrait, SoftDeletes, PresentableTrait;

    protected $fillable = ['name', 'slug', 'description'];
    protected $presenter = 'Keep\Presenters\GroupPresenter';
    protected $sluggable = ['build_from' => 'name', 'save_to' => 'slug'];

    /**
     * A group may contain multiple users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('Keep\Entities\User');
    }

    /**
     * A group can have many associated assignments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function assignments()
    {
        return $this->morphToMany('Keep\Entities\Assignment', 'assignable');
    }

    /**
     * A group can have many associated notifications.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function notifications()
    {
        return $this->morphToMany('Keep\Entities\Notification', 'notifiable');
    }

    /**
     * Notify the group.
     *
     * @param $notification
     *
     * @return Notification
     */
    public function notify($notification)
    {
        return $this->notifications()->save($notification);
    }

    /**
     * Set the route key.
     *
     * @return mixed
     */
    public function getRouteKey()
    {
        return $this->slug;
    }
}
