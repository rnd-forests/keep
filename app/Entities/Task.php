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


    public function owner()
    {
        return $this->belongsTo('Keep\Entities\User', 'user_id');
    }

    public function destroyer()
    {
        return $this->belongsTo('Keep\Entities\User', 'destroyer_id');
    }

    public function tags()
    {
        return $this->belongsToMany('Keep\Entities\Tag')->withTimestamps();
    }

    public function priority()
    {
        return $this->belongsTo('Keep\Entities\Priority', 'priority_id');
    }

    public function assignment()
    {
        return $this->belongsTo('Keep\Entities\Assignment');
    }


    public function scopeUrgent($query)
    {
        return $query->where('priority_id', 1)
            ->where('completed', 0)
            ->where('is_failed', 0)
            ->orderBy('finishing_date', 'asc');
    }

    public function scopeCompleted($query)
    {
        return $query->where('completed', 1);
    }

    public function scopeNewest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeToDeadline($query)
    {
        return $query->where('completed', 0)
            ->where('is_failed', 0)
            ->orderBy('finishing_date', 'asc');
    }

    public function scopeRecentlyCompleted($query)
    {
        return $query->where('completed', 1)
            ->orderBy('finished_at', 'desc');
    }

    public function scopeAboutToFail($query)
    {
        return $query->where('completed', 0)
            ->where('is_failed', 0)
            ->where('finishing_date', '<', Carbon::now());
    }

    public function scopeRecentlyFailed($query)
    {
        return $query->where('is_failed', 1)
            ->orderBy('created_at', 'desc');
    }

    public function scopeDue($query)
    {
        return $query->where('is_failed', 0)
            ->where('completed', 0);
    }

    public function scopeUserCreated($query)
    {
        return $query->where('user_id', '<>', 0);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('completed', 0)
            ->where('is_failed', 0)
            ->whereBetween('finishing_date', [Carbon::now(), Carbon::now()->addDays(5)]);
    }

    public function scopeSearch($query, $pattern)
    {
        return $query->where('title', 'LIKE', "%$pattern%");
    }


    public function isCompleted()
    {
        return $this->completed;
    }

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
        return $this->tags->lists('id')->all();
    }

    public function getPriorityLevelAttribute()
    {
        return is_null($this->priority) ? null : $this->priority->id;
    }

    public function getRouteKey()
    {
        return $this->slug;
    }
}
