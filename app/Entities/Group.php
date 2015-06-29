<?php

namespace Keep\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;

class Group extends Model implements SluggableInterface
{
    use SluggableTrait, SoftDeletes;

    protected $fillable = ['name', 'slug', 'description'];
    protected $sluggable = ['build_from' => 'name', 'save_to' => 'slug'];

    public function users()
    {
        return $this->belongsToMany('Keep\Entities\User');
    }

    public function assignments()
    {
        return $this->morphToMany('Keep\Entities\Assignment', 'assignable');
    }

    public function notifications()
    {
        return $this->morphToMany('Keep\Entities\Notification', 'notifiable');
    }

    public function notify($notification)
    {
        return $this->notifications()->save($notification);
    }

    public function getRouteKey()
    {
        return $this->slug;
    }
}
