<?php namespace Keep;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Keep\Exceptions\InvalidObjectException;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;

class Notification extends Model implements SluggableInterface {

    use SluggableTrait, SoftDeletes;

    /**
     * Unique slug for notification model.
     *
     * @var array
     */
    protected $sluggable = ['build_from' => 'subject', 'save_to' => 'slug'];

    /**
     * Object associated with the notification.
     *
     * @var null
     */
    private $associatedObject = null;

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
        'sender_id', 'type', 'subject', 'slug', 'body',
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
     * A notification may have a sender.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sender()
    {
        return $this->belongsTo('Keep\User', 'sender_id');
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
     * Set notification subject.
     *
     * @param $subject
     *
     * @return $this
     */
    public function withSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Set notification content.
     *
     * @param $body
     *
     * @return $this
     */
    public function withBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Set notification type.
     *
     * @param $type
     *
     * @return $this
     */
    public function withType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Set notification object.
     *
     * @param $object
     *
     * @return $this
     */
    public function regarding($object)
    {
        if (is_object($object))
        {
            $this->object_id = $object->id;
            $this->object_type = get_class($object);
        }

        return $this;
    }

    /**
     * Set sender.
     *
     * @param $user
     *
     * @return $this
     */
    public function from($user)
    {
        $this->sender()->associate($user);

        return $this;
    }

    /**
     * Send the notification.
     *
     * @return $this
     */
    public function deliver()
    {
        $this->sent_at = Carbon::now();

        $this->save();

        return $this;
    }

    /**
     * Get notification object.
     *
     * @return null
     * @throws InvalidObjectException
     */
    public function getObject()
    {
        if ($this->associatedObject)
        {
            if (!($this->hasValidObject()))
            {
                throw new InvalidObjectException('No valid object ' . $this->object_type . ' with ID ' . $this->object_id .
                    ' associated with this notification.');
            }
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
