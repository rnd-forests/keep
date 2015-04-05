<?php  namespace Keep; 

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission {

    /**
     * Table used by the model.
     * @var string
     */
    protected $table = 'permissions';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['name', 'display_name', 'description'];

}