<?php namespace Keep;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Keep\Exceptions\InvalidObjectException;
use Keep\Notifications\NotifiableInterface;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model implements NotifiableInterface {

    use SoftDeletes;

    /**
     * Object associated with the notification.
     *
     * @var null
     */
    private $notificationObject = null;

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
        'user_id', 'sender_id', 'type', 'subject', 'body',
        'object_id', 'object_type', 'is_read', 'sent_at'
    ];

    /**
     * A notification belongs to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Keep\User', 'user_id');
    }

    /**
     * A notification belongs to a sender.
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
        $query->where('is_read', '=', false);
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
     * Set receiver.
     *
     * @param $user
     *
     * @return $this
     */
    public function to($user)
    {
        $this->user()->associate($user);

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
        if ($this->notificationObject)
        {
            if (!($this->hasValidObject()))
            {
                throw new InvalidObjectException('No valid object ' . $this->object_type . ' with ID ' . $this->object_id .
                    ' associated with this notification.');
            }
        }

        return $this->notificationObject;
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
            $this->notificationObject = $object;
            return true;
        }

        return false;
    }

}
