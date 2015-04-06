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
     * @var array
     */
    protected $sluggable = ['build_from' => 'title', 'save_to' => 'slug'];

    /**
     * Table used by the model.
     * @var string
     */
    protected $table = 'tasks';

    /**
     * Task presenter.
     * @var string
     */
    protected $presenter = 'Keep\Presenters\TaskPresenter';

    /**
     * The attributes that should be treated as Carbon instances.
     * @var array
     */
    protected $dates = ['starting_date', 'finishing_date', 'finished_at', 'deleted_at'];

    /**
     * The attributes that should be casted to native types.
     * @var array
     */
    protected $casts = ['completed' => 'boolean'];

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'title', 'slug', 'content', 'user_id', 'location', 'note',
        'starting_date', 'finishing_date', 'finished_at', 'completed'
    ];

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
     * Get the tags associated with given task.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('Keep\Tag');
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

    //--- ACCESSORS vs. MUTATORS ---//
    public function setStartingDateAttribute($date)
    {
        $this->attributes['starting_date'] = Carbon::parse($date);
    }

    public function getStartingDateAttribute($date)
    {
        return Carbon::parse($date)->format('F d, Y H:i');
    }

    public function setFinishingDateAttribute($date)
    {
        $this->attributes['finishing_date'] = Carbon::parse($date);
    }

    public function getFinishingDateAttribute($date)
    {
        return Carbon::parse($date)->format('F d, Y H:i');
    }

    public function setFinishedAtAttribute($date)
    {
        $this->attributes['finished_at'] = Carbon::parse($date);
    }

    public function getTagListAttribute()
    {
        return $this->tags->lists('id');
    }

}
