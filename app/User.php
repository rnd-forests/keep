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

    use Authenticatable, CanResetPassword, PresentableTrait, SluggableTrait, SoftDeletes, EntrustUserTrait;

    /**
     * Unique slug for user model.
     *
     * @var array
     */
    protected $sluggable = ['build_from' => 'name', 'save_to' => 'slug'];

    /**
     * Table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

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
        'name', 'email', 'address', 'company', 'website', 'password',
        'phone', 'about', 'activation_code', 'active'
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notifications()
    {
        return $this->hasMany('Keep\Notification');
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
     * Create new notification.
     *
     * @return Notification
     */
    public function createNotification()
    {
        $notification = new Notification();
        $notification->user()->associate($this);

        return $notification;
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

}
