<?php namespace Keep;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;

class Assignment extends Model implements SluggableInterface {

    use SluggableTrait;

    /**
     * Unique slug for assignment model.
     *
     * @var array
     */
    protected $sluggable = ['build_from' => 'name', 'save_to' => 'slug'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug'];

    /**
     * An assignment can be assigned to many users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function users()
    {
        return $this->morphedByMany('Keep\User', 'assignable');
    }

    /**
     * An assignment can be assigned to many groups.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function groups()
    {
        return $this->morphedByMany('Keep\Group', 'assignable');
    }

    /**
     * An assignment has one associated task.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function task()
    {
        return $this->hasOne('Keep\Task');
    }

}
