<?php
namespace Keep\Entities;

use Exception;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Keep\Exceptions\InvalidObjectException;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;

class Notification extends Model implements SluggableInterface
{
    use SluggableTrait;

    protected $dates = ['sent_at'];
    protected $associatedObject = null;
    protected $sluggable = ['build_from' => 'subject', 'save_to' => 'slug'];
    protected $fillable = [
        'sent_from', 'type', 'subject', 'slug', 'body',
        'object_id', 'object_type', 'sent_at'
    ];


    public function users()
    {
        return $this->morphedByMany('Keep\Entities\User', 'notifiable');
    }

    public function groups()
    {
        return $this->morphedByMany('Keep\Entities\Group', 'notifiable');
    }


    public function scopeOld($query)
    {
        return $query->where('sent_at', '<=', Carbon::now()->subDays(10));
    }


    public function getObject()
    {
        if (!$this->associatedObject && !$this->hasValidObject()) {
            throw new InvalidObjectException('No valid object ' . $this->object_type .
                ' with ID ' . $this->object_id . ' associated with this notification.');
        }

        return $this->associatedObject;
    }

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

    public function getRouteKey()
    {
        return $this->slug;
    }
}
