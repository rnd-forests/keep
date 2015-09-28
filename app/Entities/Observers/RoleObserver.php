<?php

namespace Keep\Entities\Observers;

use Keep\Entities\Role;

class RoleObserver
{
    /**
     * Hook into role deleting event.
     *
     * @param Role $role
     */
    public function deleting(Role $role)
    {
        if (!method_exists($role, 'bootSoftDeletes')) {
            $role->users()->sync([]);
            $role->permissions()->sync([]);
        }
    }
}