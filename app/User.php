<?php namespace Keep;

use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Keep\Exceptions\InvalidRoleException;
use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract, SluggableInterface {

	use Authenticatable, CanResetPassword, PresentableTrait, SluggableTrait, SoftDeletes;

    /**
     * Unique slug for user model.
     * @var array
     */
    protected $sluggable = ['build_from' => 'name', 'save_to' => 'slug'];

    /**
     * Table used by the model.
     * @var string
     */
	protected $table = 'users';

    /**
     * User presenter.
     * @var string
     */
    protected $presenter = 'Keep\Presenters\UserPresenter';

    /**
     * The attributes that should be treated as Carbon instances.
     * @var array
     */
    protected $dates = ['birthday', 'deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
	protected $hidden = ['password', 'remember_token', 'activation_code', 'active'];

    /**
     * The attributes that should be casted to native types.
     * @var array
     */
    protected $casts = ['active' => 'boolean'];

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'address', 'company', 'website', 'password',
        'phone', 'about', 'birthday', 'activation_code', 'active'
    ];

    /**
     * A user can have many associated roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('Keep\Role');
    }

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
     * Determine if the user has confirmed his email address already or not.
     *
     * @return bool
     */
    public function isConfirmed()
    {
        return (bool) $this->active;
    }

    /**
     * Check if a user is admin user or not.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->hasRoles(['manage_users', 'manage_tasks']);
    }

    /**
     * Validate given role against database roles.
     *
     * @param array $roles
     *
     * @return bool
     * @throws InvalidRoleException
     */
    public function hasRoles($roles = array())
    {
        $roleList = app()->make('Keep\Repositories\Role\RoleRepository')->getRoleList();

        foreach ((array) $roles as $role)
        {
            if (! in_array($role, $roleList))
            {
                throw new InvalidRoleException("Unidentified role: {$role}");
            }

            if (! $this->roleCollectionHasRole($role))
            {
                return false;
            }
        }

        return true;
    }

    /**
     * Compare roles.
     *
     * @param $allowedRole
     *
     * @return bool
     */
    private function roleCollectionHasRole($allowedRole)
    {
        $roles = $this->roles()->get();

        if ($roles)
        {
            foreach ($roles as $role)
            {
                if (strtolower($role->name) == strtolower($allowedRole))
                {
                    return true;
                }
            }
        }

        return false;
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


    //--- ACCESSORS vs. MUTATORS ---//
    public function setRolesAttribute($roles)
    {
        return $this->roles()->sync((array) $roles);
    }

    public function setBirthdayAttribute($date)
    {
        $this->attributes['birthday'] = Carbon::parse($date);
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

}
