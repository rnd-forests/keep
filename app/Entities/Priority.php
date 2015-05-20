<?php namespace Keep\Entities;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'value', 'description'];

    /**
     * A priority level can have many associated tasks.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany('Keep\Entities\Task');
    }

    /**
     * Set the route key.
     *
     * @return mixed
     */
    public function getRouteKey()
    {
        return $this->name;
    }

}
