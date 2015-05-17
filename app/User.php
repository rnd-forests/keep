<?php namespace Keep;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract, SluggableInterface {

    use Authenticatable, CanResetPassword, PresentableTrait,
        SluggableTrait, SoftDeletes, EntrustUserTrait;

    /**
     * Unique slug for user model.
     *
     * @var array
     */
    protected $sluggable = ['build_from' => 'name', 'save_to' => 'slug'];

    /**
     * User presenter.
     *
     * @var string
     */
    protected $presenter = 'Keep\Presenters\UserPresenter';

    /**
     * The attributes that should be treated as Carbon instances.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'activation_code'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['active' => 'boolean'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'activation_code', 'active'
    ];

    /**
     * A user can have many associated tasks.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany('Keep\Task');
    }

    /**
     * A user can have many associated notifications.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function notifications()
    {
        return $this->morphToMany('Keep\Notification', 'notifiable');
    }

    /**
     * A user can belong to many different groups.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function groups()
    {
        return $this->belongsToMany('Keep\Group');
    }

    /**
     * A User can have many associated assignments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function assignments()
    {
        return $this->morphToMany('Keep\Assignment', 'assignable');
    }

    /**
     * A user has one associated profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne('Keep\Profile');
    }

    /**
     * Determine if the user has confirmed his email address already or not.
     *
     * @return bool
     */
    public function isConfirmed()
    {
        return $this->active;
    }

    /**
     * Check if a user is admin user or not.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    /**
     * Notify the user.
     *
     * @param $notification
     *
     * @return Notification
     */
    public function notify($notification)
    {
        return $this->notifications()->save($notification);
    }

    /**
     * Encrypting user password.
     *
     * @param $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
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

}
