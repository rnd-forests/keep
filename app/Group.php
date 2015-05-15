<?php namespace Keep;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Keep\Notifications\NotifiableInterface;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;

class Group extends Model implements SluggableInterface, NotifiableInterface {

    use SluggableTrait, SoftDeletes, PresentableTrait;

    /**
     * Unique slug for group model.
     *
     * @var array
     */
    protected $sluggable = ['build_from' => 'name', 'save_to' => 'slug'];

    /**
     * Group presenter.
     *
     * @var string
     */
    protected $presenter = 'Keep\Presenters\GroupPresenter';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description'];

    /**
     * A group may contain multiple users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('Keep\User');
    }

    /**
     * A group can have many associated assignments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function assignments()
    {
        return $this->morphToMany('Keep\Assignment', 'assignable');
    }

    /**
     * A group can have many associated notifications.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function notifications()
    {
        return $this->morphToMany('Keep\Notification', 'notifiable');
    }

    /**
     * Notify the group.
     *
     * @return Notification
     */
    public function notify()
    {
        $notification = new Notification();
        $notification->groups()->attach($this->id);

        return $notification;
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
