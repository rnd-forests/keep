<?php
namespace Keep\Entities;

use Exception;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Keep\Exceptions\InvalidObjectException;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;

class Notification extends Model implements SluggableInterface
{
    use SluggableTrait, PresentableTrait;

    protected $dates = ['sent_at'];
    protected $associatedObject = null;
    protected $presenter = 'Keep\Presenters\NotificationPresenter';
    protected $sluggable = ['build_from' => 'subject', 'save_to' => 'slug'];
    protected $fillable = [
        'sent_from', 'type', 'subject', 'slug', 'body',
        'object_id', 'object_type', 'sent_at'
    ];

    /**
     * A notification can belong to many users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function users()
    {
        return $this->morphedByMany('Keep\Entities\User', 'notifiable');
    }

    /**
     * A notification can belong to many groups.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function groups()
    {
        return $this->morphedByMany('Keep\Entities\Group', 'notifiable');
    }

    /**
     * Old notifications query scope.
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeOld($query)
    {
        return $query->where('sent_at', '<=', Carbon::now()->subDays(10));
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

    /**
     * Get notification object.
     *
     * @throws InvalidObjectException
     */
    public function getObject()
    {
        if ( ! $this->associatedObject && ! $this->hasValidObject()) {
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
        try {
            $object = call_user_func_array($this->object_type . '::findOrFail', [$this->object_id]);
        } catch (Exception $e) {
            return false;
        }

        $this->associatedObject = $object;

        return true;
    }
}
