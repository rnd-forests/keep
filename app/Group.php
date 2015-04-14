<?php namespace Keep;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;

class Group extends Model implements SluggableInterface {

    use SluggableTrait, SoftDeletes, PresentableTrait;

    /**
     * Unique slug for group model.
     * @var array
     */
    protected $sluggable = ['build_from' => 'name', 'save_to' => 'slug'];

    /**
     * Table used by the model.
     * @var string
     */
    protected $table = 'groups';

    /**
     * Group presenter.
     * @var string
     */
    protected $presenter = 'Keep\Presenters\GroupPresenter';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description'];

    /**
     * A group may contain multiple users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('Keep\User');
    }

}
