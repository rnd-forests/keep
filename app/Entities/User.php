<?php

namespace Keep\Entities;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Keep\Entities\Presenters\UserPresenter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Keep\Entities\Presenters\Traits\PresentableTrait;
use Keep\Entities\Presenters\Contracts\PresentableInterface;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract,
    SluggableInterface,
    PresentableInterface
{
    use Authenticatable,
        Authorizable,
        CanResetPassword,
        PresentableTrait,
        SluggableTrait,
        SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $casts = ['active' => 'boolean'];
    protected $presenter = UserPresenter::class;
    protected $sluggable = ['build_from' => 'name', 'save_to' => 'slug'];
    protected $hidden = ['password', 'remember_token', 'activation_code'];
    protected $fillable = [
        'name', 'email', 'password', 'activation_code',
        'active', 'auth_provider_id', 'auth_provider',
    ];

    /**
     * The profile associated with a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * A user can have many associated tasks.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Notifications associated with a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function notifications()
    {
        return $this->morphToMany(Notification::class, 'notifiable');
    }

    /**
     * Joined groups of a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    /**
     * Roles associated with a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Checking roles of a user.
     *
     * @param $name
     * @param bool|false $all
     * @return bool
     */
    public function hasRole($name, $all = false)
    {
        if (is_array($name)) {
            foreach ($name as $roleName) {
                $hasRole = $this->hasRole($roleName);

                if ($hasRole && !$all) {
                    return true;
                } elseif (!$hasRole && $all) {
                    return false;
                }
            }

            return $all;
        } else {
            foreach ($this->roles as $role) {
                if ($role->name == $name) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Check permissions of a user.
     *
     * @param $permission
     * @param bool|false $all
     * @return bool
     */
    public function canDo($permission, $all = false)
    {
        if (is_array($permission)) {
            foreach ($permission as $permName) {
                $hasPerm = $this->canDo($permName);

                if ($hasPerm && !$all) {
                    return true;
                } elseif (!$hasPerm && $all) {
                    return false;
                }
            }

            return $all;
        } else {
            foreach ($this->roles as $role) {
                foreach ($role->permissions as $perm) {
                    if ($perm->name == $permission) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    /**
     * Assign a role to a user.
     *
     * @param $role
     */
    public function attachRole($role)
    {
        if (is_object($role)) {
            $role = $role->getKey();
        }

        if (is_array($role)) {
            $role = $role['id'];
        }

        $this->roles()->attach($role);
    }

    /**
     * Remove a role from a user.
     *
     * @param $role
     */
    public function detachRole($role)
    {
        if (is_object($role)) {
            $role = $role->getKey();
        }

        if (is_array($role)) {
            $role = $role['id'];
        }

        $this->roles()->detach($role);
    }

    /**
     * Assign roles to a user.
     *
     * @param $roles
     */
    public function attachRoles($roles)
    {
        foreach ($roles as $role) {
            $this->attachRole($role);
        }
    }

    /**
     * Remove roles from a user.
     *
     * @param $roles
     */
    public function detachRoles($roles)
    {
        foreach ($roles as $role) {
            $this->detachRole($role);
        }
    }

    /**
     * Check if user's account is activated.
     *
     * @return mixed
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * Check if a user has administrator role or not.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->hasRole(['admin', 'owner']);
    }

    /**
     * Notify a user.
     *
     * @param $notification
     * @return Model
     */
    public function notify($notification)
    {
        return $this->notifications()->save($notification);
    }

    /**
     * Encrypt password attribute of a user (mutator).
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
     * @return string
     */
    public function getRouteKey()
    {
        return $this->slug;
    }
}
