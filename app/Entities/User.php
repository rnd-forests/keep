<?php
namespace Keep\Entities;

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

class User extends Model implements AuthenticatableContract, CanResetPasswordContract, SluggableInterface
{
    use Authenticatable, CanResetPassword, PresentableTrait,
        SluggableTrait, SoftDeletes, EntrustUserTrait;

    protected $dates = ['deleted_at'];
    protected $casts = ['active' => 'boolean'];
    protected $presenter = 'Keep\Presenters\UserPresenter';
    protected $sluggable = ['build_from' => 'name', 'save_to' => 'slug'];
    protected $hidden = ['password', 'remember_token', 'activation_code'];
    protected $fillable = [
        'name', 'email', 'password', 'activation_code',
        'active', 'auth_provider_id', 'auth_provider'
    ];

    /**
     * A user can have many associated tasks.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany('Keep\Entities\Task');
    }

    /**
     * A user can have many associated notifications.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function notifications()
    {
        return $this->morphToMany('Keep\Entities\Notification', 'notifiable');
    }

    /**
     * A user can belong to many different groups.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function groups()
    {
        return $this->belongsToMany('Keep\Entities\Group');
    }

    /**
     * A User can have many associated assignments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function assignments()
    {
        return $this->morphToMany('Keep\Entities\Assignment', 'assignable');
    }

    /**
     * A user has one associated profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne('Keep\Entities\Profile');
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
