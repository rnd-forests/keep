<?php namespace Keep;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

    /**
     * Table used by the model.
     * @var string
     */
    protected $table = 'roles';

    /**
     * Disable timestamps.
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
	protected $fillable = ['name', 'description'];

    /**
     * A role can belongs to many users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('Keep\User');
    }

}
