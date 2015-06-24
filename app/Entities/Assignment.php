<?php

namespace Keep\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;

class Assignment extends Model implements SluggableInterface
{
    use SoftDeletes, SluggableTrait;

    protected $fillable = ['assignment_name', 'slug'];
    protected $sluggable = ['build_from' => 'assignment_name', 'save_to' => 'slug'];

    public function users()
    {
        return $this->morphedByMany('Keep\Entities\User', 'assignable');
    }

    public function groups()
    {
        return $this->morphedByMany('Keep\Entities\Group', 'assignable');
    }

    public function task()
    {
        return $this->hasOne('Keep\Entities\Task');
    }

    public function getRouteKey()
    {
        return $this->slug;
    }
}
