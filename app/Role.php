<?php namespace Keep;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'display_name', 'description'];

}