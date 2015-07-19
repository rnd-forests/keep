<?php

namespace Keep\Entities;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;

class Tag extends Model implements SluggableInterface
{
    use SluggableTrait;

    protected $fillable = ['name'];
    protected $sluggable = ['build_from' => 'name', 'save_to' => 'slug'];

    public function tasks()
    {
        return $this->belongsToMany(\Keep\Entities\Task::class);
    }

    public function getRouteKey()
    {
        return $this->slug;
    }
}
