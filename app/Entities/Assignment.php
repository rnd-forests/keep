<?php namespace Keep\Entities;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;

class Assignment extends Model implements SluggableInterface {

    use SoftDeletes, SluggableTrait, PresentableTrait;

    /**
     * Unique slug for assignment model.
     *
     * @var array
     */
    protected $sluggable = ['build_from' => 'assignment_name', 'save_to' => 'slug'];

    /**
     * Group presenter.
     *
     * @var string
     */
    protected $presenter = 'Keep\Presenters\AssignmentPresenter';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['assignment_name', 'slug'];

    /**
     * An assignment can be assigned to many users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function users()
    {
        return $this->morphedByMany('Keep\Entities\User', 'assignable');
    }

    /**
     * An assignment can be assigned to many groups.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function groups()
    {
        return $this->morphedByMany('Keep\Entities\Group', 'assignable');
    }

    /**
     * An assignment has one associated task.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function task()
    {
        return $this->hasOne('Keep\Entities\Task');
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
