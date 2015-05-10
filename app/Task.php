<?php namespace Keep;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;

class Task extends Model implements SluggableInterface {

    use PresentableTrait, SluggableTrait, SoftDeletes;

    /**
     * Unique slug for task model.
     *
     * @var array
     */
    protected $sluggable = ['build_from' => 'title', 'save_to' => 'slug'];

    /**
     * Task presenter.
     *
     * @var string
     */
    protected $presenter = 'Keep\Presenters\TaskPresenter';

    /**
     * The attributes that should be treated as Carbon instances.
     *
     * @var array
     */
    protected $dates = ['starting_date', 'finishing_date', 'finished_at', 'deleted_at'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['completed' => 'boolean', 'isAssigned' => 'boolean'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'destroyer_id', 'priority_id', 'assignment_id',
        'title', 'slug', 'content', 'location', 'starting_date',
        'finishing_date', 'finished_at', 'completed', 'is_assigned',
        'deleted_at'
    ];

    /**
     * Touching parent timestamps.
     *
     * @var array
     */
    protected $touches = ['owner', 'assignment'];

    /**
     * A task belongs to a specific user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo('Keep\User', 'user_id');
    }

    /**
     * Get the user who deleted a specific task.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function destroyer()
    {
        return $this->belongsTo('Keep\User', 'destroyer_id');
    }

    /**
     * Get the tags associated with given task.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('Keep\Tag');
    }

    /**
     * A task has an associated priority level.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function priority()
    {
        return $this->belongsTo('Keep\Priority', 'priority_id');
    }

    /**
     * A task belongs to a specific assignment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function assignment()
    {
        return $this->belongsTo('Keep\Assignment');
    }

    /**
     * Check if a task is completed or not.
     *
     * @return mixed
     */
    public function isCompleted()
    {
        return $this->completed;
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

    /*
     * Get ten most urgent tasks.
     * 
     * @param $query
     *
     * @return mixed
     */
    public function scopeUrgent($query)
    {
        return $query->where('priority_id', 1)
            ->where('completed', 0)
            ->orderBy('finishing_date', 'asc')
            ->take(10);
    }

    /**
     * Completed tasks query scope.
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeCompleted($query)
    {
        return $query->where('completed', 1);
    }

    /**
     * Get ten task up to deadline.
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeToDeadline($query)
    {
        return $query->where('completed', 0)
            ->orderBy('finishing_date', 'asc')
            ->take(10);
    }

    //--- ACCESSORS vs. MUTATORS ---//
    public function setStartingDateAttribute($date)
    {
        $this->attributes['starting_date'] = Carbon::parse($date);
    }

    public function getStartingDateAttribute($date)
    {
        return Carbon::parse($date)->format('m/d/Y');
    }

    public function setFinishingDateAttribute($date)
    {
        $this->attributes['finishing_date'] = Carbon::parse($date);
    }

    public function getFinishingDateAttribute($date)
    {
        return Carbon::parse($date)->format('m/d/Y');
    }

    public function setFinishedAtAttribute($date)
    {
        if ($this->isCompleted()) $this->attributes['finished_at'] = Carbon::parse($date);
        else $this->attributes['finished_at'] = null;
    }

    public function getTagListAttribute()
    {
        return $this->tags->lists('id');
    }

}
