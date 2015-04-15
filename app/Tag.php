<?php namespace Keep;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

    /**
     * The attributes that are mass assignable.
     * @var array
     */
	protected $fillable = ['name'];

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
