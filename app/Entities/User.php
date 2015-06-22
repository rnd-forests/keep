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


    public function profile()
    {
        return $this->hasOne('Keep\Entities\Profile');
    }

    public function tasks()
    {
        return $this->hasMany('Keep\Entities\Task');
    }

    public function notifications()
    {
        return $this->morphToMany('Keep\Entities\Notification', 'notifiable');
    }

    public function groups()
    {
        return $this->belongsToMany('Keep\Entities\Group')->withTimestamps();
    }

    public function assignments()
    {
        return $this->morphToMany('Keep\Entities\Assignment', 'assignable');
    }


    public function isActive()
    {
        return $this->active;
    }

    public function isAdmin()
    {
        return $this->hasRole('admin');
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
