<?php namespace Keep;

use Exception;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model {

    use SoftDeletes;

    /**
     * Object associated with the notification.
     * @var null
     */
    private $notificationObject = null;

    /**
     * Table used by the model.
     * @var string
     */
    protected $table = 'notifications';

    /**
     * The attributes that should be treated as Carbon instances.
     * @var array
     */
    protected $dates = ['sent_at', 'deleted_at'];

    /**
     * The attributes that should be casted to native types.
     * @var array
     */
    protected $casts = ['is_read' => 'boolean'];

    /**
     * The attributes that are mass assignable.
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
    public function setSubject($subject)
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
    public function setBody($body)
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
    public function setType($type)
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
     * Check if the object associated with the notification is valid or not.
     *
     * @return bool
     */
    public function hasValidObject()
    {
        try
        {
            $object = call_user_func_array(
                $this->object_type . '::findOrFail', [$this->object_id]
            );
        }
        catch (Exception $e)
        {
            return false;
        }

        $this->notificationObject = $object;

        return true;
    }

    /**
     * Get notification object.
     *
     * @return null
     * @throws Exception
     */
    public function getObject()
    {
        if($this->notificationObject)
        {
            $hasObject = $this->hasValidObject();

            if(!$hasObject)
            {
                throw new Exception(sprintf(
                    "No valid object (%s with ID %s) associated with this notification.",
                    $this->object_type, $this->object_id
                ));
            }
        }

        return $this->notificationObject;
    }

}
