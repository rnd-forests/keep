<?php namespace Keep;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model {

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
	protected $fillable = ['name'];

    /**
     * The attributes that should be treated as Carbon instances.
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get the tasks associated with given tag.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tasks()
    {
        return $this->belongsToMany('Keep\Task');
    }

}
