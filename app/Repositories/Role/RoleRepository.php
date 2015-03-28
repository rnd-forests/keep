<?php  namespace Keep\Repositories\Role; 

use Keep\Role;

class RoleRepository {

    /**
     * Get the list of roles.
     *
     * @return mixed
     */
    public function getRoleList()
    {
        return Role::lists('name', 'id');
    }

}