<?php

namespace Keep\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;

class Notification extends Model implements SluggableInterface
{
    use SluggableTrait;

    protected $dates = ['sent_at'];
    protected $attachedObject = null;
    protected $sluggable = ['build_from' => 'subject', 'save_to' => 'slug'];
    protected $fillable = [
        'sent_from', 'type', 'subject', 'slug', 'body',
        'object_id', 'object_type', 'sent_at',
    ];

    public function users()
    {
        return $this->morphedByMany(User::class, 'notifiable');
    }

    public function groups()
    {
        return $this->morphedByMany(Group::class, 'notifiable');
    }

    public function scopeOld($query)
    {
        return $query->where('sent_at', '<=', Carbon::now()->subDays(10));
    }

    public function getObject()
    {
        $this->attachedObject = call_user_func_array(
            $this->object_type . '::findOrFail',
            [$this->object_id]
        );

        return $this->attachedObject;
    }

    public function getRouteKey()
    {
        return $this->slug;
    }
}
