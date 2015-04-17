<?php namespace Keep;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole {

    /**
     * Table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'display_name', 'description'];

}