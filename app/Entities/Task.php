<?php

namespace Keep\Entities;

use Carbon\Carbon;
use Keep\Entities\Scopes\TaskScopes;
use Illuminate\Database\Eloquent\Model;
use Keep\Entities\Presenters\TaskPresenter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Keep\Entities\Presenters\Traits\PresentableTrait;
use Keep\Entities\Presenters\Contracts\PresentableInterface;

class Task extends Model implements
    SluggableInterface,
    PresentableInterface
{
    use TaskScopes,
        PresentableTrait,
        SluggableTrait,
        SoftDeletes;

    protected $touches = ['user'];
    protected $presenter = TaskPresenter::class;
    protected $sluggable = ['build_from' => 'title', 'save_to' => 'slug'];
    protected $dates = ['starting_date', 'finishing_date', 'finished_at', 'deleted_at'];
    protected $casts = ['completed' => 'boolean', 'is_failed' => 'boolean'];
    protected $fillable = [
        'user_id', 'priority_id', 'title', 'slug', 'content', 'location', 'starting_date',
        'finishing_date', 'is_failed', 'finished_at', 'completed', 'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }

    public function isCompleted()
    {
        return $this->completed;
    }

    public function setStartingDateAttribute($date)
    {
        $this->attributes['starting_date'] = Carbon::parse($date);
    }

    public function setFinishingDateAttribute($date)
    {
        $this->attributes['finishing_date'] = Carbon::parse($date);
    }

    public function getStartingDateAttribute($date)
    {
        return Carbon::parse($date)->format('m/d/Y h:i A');
    }

    public function getFinishingDateAttribute($date)
    {
        return Carbon::parse($date)->format('m/d/Y h:i A');
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
