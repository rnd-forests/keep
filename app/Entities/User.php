<?php

namespace Keep\Entities;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Keep\Entities\Presenters\UserPresenter;
use Zizaco\Entrust\Traits\EntrustUserTrait;
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
        SoftDeletes,
        EntrustUserTrait {
            Authorizable::can insteadof EntrustUserTrait;
        }

    protected $dates = ['deleted_at'];
    protected $casts = ['active' => 'boolean'];
    protected $presenter = UserPresenter::class;
    protected $sluggable = ['build_from' => 'name', 'save_to' => 'slug'];
    protected $hidden = ['password', 'remember_token', 'activation_code'];
    protected $fillable = [
        'name', 'email', 'password', 'activation_code',
        'active', 'auth_provider_id', 'auth_provider',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function notifications()
    {
        return $this->morphToMany(Notification::class, 'notifiable');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    public function isActive()
    {
        return $this->active;
    }

    public function isAdmin()
    {
        return $this->hasRole(['admin', 'owner']);
    }

    public function notify($notification)
    {
        return $this->notifications()->save($notification);
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function getRouteKey()
    {
        return $this->slug;
    }
}
