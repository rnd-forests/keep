<?php namespace Keep;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = ['location', 'bio', 'company', 'website', 'phone', 'twitter_username', 'github_username'];

    /**
     * A profile belongs to one specific user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Keep\User');
    }

}
