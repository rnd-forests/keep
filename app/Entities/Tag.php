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
     * Get the tasks associated with given tag.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tasks()
    {
        return $this->belongsToMany('Keep\Entities\Task');
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
}
