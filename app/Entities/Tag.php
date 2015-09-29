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

    /**
     * Associated tasks of a tag.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }

    /**
     * Set the route key.
     *
     * @return string
     */
    public function getRouteKey()
    {
        return $this->slug;
    }
}
