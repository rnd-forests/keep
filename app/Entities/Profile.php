<?php

namespace Keep\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'location', 'bio', 'company', 'website', 'phone',
        'github_username', 'google_username', 'facebook_username',
    ];

    public function user()
    {
        return $this->belongsTo(\Keep\Entities\User::class);
    }
}
