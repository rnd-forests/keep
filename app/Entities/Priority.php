<?php
namespace Keep\Entities;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    protected $fillable = ['name', 'value', 'description'];


    public function tasks()
    {
        return $this->hasMany('Keep\Entities\Task');
    }


    public function getRouteKey()
    {
        return $this->name;
    }
}
