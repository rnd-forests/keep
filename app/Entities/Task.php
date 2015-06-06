<?php
namespace Keep\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;

class Task extends Model implements SluggableInterface
{
    use PresentableTrait, SluggableTrait, SoftDeletes;

    protected $touches = ['owner', 'assignment'];
    protected $presenter = 'Keep\Presenters\TaskPresenter';
    protected $sluggable = ['build_from' => 'title', 'save_to' => 'slug'];
    protected $dates = ['starting_date', 'finishing_date', 'finished_at', 'deleted_at'];
    protected $casts = ['completed' => 'boolean', 'is_assigned' => 'boolean', 'is_failed' => 'boolean'];
    protected $fillable = [
        'user_id', 'destroyer_id', 'priority_id', 'assignment_id',
        'title', 'slug', 'content', 'location', 'starting_date',
        'finishing_date', 'finished_at', 'completed', 'is_assigned',
        'deleted_at'
    ];

    /**
     * A task belongs to a specific user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo('Keep\Entities\User', 'user_id');
    }

    /**
     * Get the user who deleted a specific task.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function destroyer()
    {
        return $this->belongsTo('Keep\Entities\User', 'destroyer_id');
    }

    /**
     * Get the tags associated with given task.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('Keep\Entities\Tag');
    }

    /**
     * A task has an associated priority level.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function priority()
    {
        return $this->belongsTo('Keep\Entities\Priority', 'priority_id');
    }

    /**
     * A task belongs to a specific assignment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function assignment()
    {
        return $this->belongsTo('Keep\Entities\Assignment');
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
     * Urgent tasks query scope.
     * 
     * @param $query
     *
     * @return mixed
     */
    public function scopeUrgent($query)
    {
        return $query->where('priority_id', 1)
            ->where('completed', 0)
            ->where('is_failed', 0)
            ->orderBy('finishing_date', 'asc');
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
     * Newest tasks query scope.
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeNewest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Deadline tasks query scope.
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeToDeadline($query)
    {
        return $query->where('completed', 0)
            ->where('is_failed', 0)
            ->orderBy('finishing_date', 'asc');
    }

    /**
     * Recently completed tasks query scope.
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeRecentlyCompleted($query)
    {
        return $query->where('completed', 1)
            ->orderBy('finished_at', 'desc');
    }

    /**
     * Failed tasks query scope.
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeAboutToFail($query)
    {
        return $query->where('completed', 0)
            ->where('is_failed', 0)
            ->where('finishing_date', '<', Carbon::now());
    }

    /**
     * Recently failed tasks query scope.
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeRecentlyFailed($query)
    {
        return $query->where('is_failed', 1)
            ->orderBy('created_at', 'desc');
    }

    /**
     * Due tasks query scope.
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeDue($query)
    {
        return $query->where('is_failed', 0)
            ->where('completed', 0);
    }

    /**
     * User created tasks query scope.
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeUserCreated($query)
    {
        return $query->where('user_id', '<>', 0);
    }

    /**
     * Upcoming tasks query scope.
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeUpcoming($query)
    {
        return $query->where('completed', 0)
            ->where('is_failed', 0)
            ->whereBetween('finishing_date', [Carbon::now(), Carbon::now()->addDays(5)]);
    }

    /**
     * Search tasks by title query scope.
     *
     * @param $query
     * @param $pattern
     *
     * @return mixed
     */
    public function scopeSearch($query, $pattern)
    {
        return $query->where('title', 'LIKE', "%$pattern%");
    }

    //--- ACCESSORS vs. MUTATORS ---//
    public function setStartingDateAttribute($date)
    {
        $this->attributes['starting_date'] = Carbon::parse($date);
    }

    public function getStartingDateAttribute($date)
    {
        return Carbon::parse($date)->format('m/d/Y h:i A');
    }

    public function setFinishingDateAttribute($date)
    {
        $this->attributes['finishing_date'] = Carbon::parse($date);
    }

    public function getFinishingDateAttribute($date)
    {
        return Carbon::parse($date)->format('m/d/Y h:i A');
    }

    public function setFinishedAtAttribute($date)
    {
        if ($this->isCompleted()) {
            $this->attributes['finished_at'] = Carbon::parse($date);
        } else {
            $this->attributes['finished_at'] = null;
        }
    }

    public function getTagListAttribute()
    {
        return $this->tags->lists('id');
    }
}
