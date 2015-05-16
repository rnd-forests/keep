<?php namespace Keep;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Keep\Exceptions\InvalidObjectException;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;

class Notification extends Model implements SluggableInterface {

    use SluggableTrait, PresentableTrait;

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
    protected $dates = ['sent_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sent_from', 'type', 'subject', 'slug', 'body',
        'object_id', 'object_type', 'is_read'
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
        try
        {
            $object = call_user_func_array($this->object_type . '::findOrFail', [$this->object_id]);
        }
        catch(Exception $e)
        {
            return false;
        }

        $this->associatedObject = $object;

        return true;
    }

}
