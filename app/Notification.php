<?php namespace Keep;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Keep\Exceptions\InvalidObjectException;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;

class Notification extends Model implements SluggableInterface {

    use SluggableTrait, SoftDeletes, PresentableTrait;

    /**
     * The object associated with a given notification.
     *
     * @var null
     */
    protected $associatedObject = null;

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
        'sent_from', 'type', 'subject', 'slug', 'body',
        'object_id', 'object_type', 'is_read', 'sent_at'
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

    /**
     * Get notification object.
     *
     * @throws InvalidObjectException
     */
    public function getObject()
    {
        if (!$this->associatedObject && !$this->hasValidObject())
        {
            throw new InvalidObjectException('No valid object ' . $this->object_type .
                ' with ID ' . $this->object_id . ' associated with this notification.');
        }

        return $this->associatedObject;
    }

    /**
     * Check if the object associated with the notification is valid or not.
     *
     * @return bool
     */
    public function hasValidObject()
    {
        $object = call_user_func_array($this->object_type . '::findOrFail', [$this->object_id]);

        if ($object != null)
        {
            $this->associatedObject = $object;
            return true;
        }

        return false;
    }

}
