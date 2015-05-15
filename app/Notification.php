<?php namespace Keep;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;

class Notification extends Model implements SluggableInterface {

    use SluggableTrait, SoftDeletes, PresentableTrait;

    /**
     * Unique slug for notification model.
     *
     * @var array
     */
    protected $sluggable = ['build_from' => 'subject', 'save_to' => 'slug'];

    /**
     * Notification presenter.
     *
     * @var string
     */
    protected $presenter = 'Keep\Presenters\NotificationPresenter';

    /**
     * The attributes that should be treated as Carbon instances.
     *
     * @var array
     */
    protected $dates = ['sent_at', 'deleted_at'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['is_read' => 'boolean'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'subject', 'slug', 'body', 'object_id',
        'object_type', 'is_read', 'sent_at'
    ];

    /**
     * A notification can belong to many users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function users()
    {
        return $this->morphedByMany('Keep\User', 'notifiable');
    }

    /**
     * A notification can belong to many groups.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function groups()
    {
        return $this->morphedByMany('Keep\Group', 'notifiable');
    }

    /**
     * Query scope for unread notifications.
     *
     * @param $query
     */
    public function scopeUnread($query)
    {
        $query->where('is_read', 0);
    }

}
