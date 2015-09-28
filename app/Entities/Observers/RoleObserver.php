<?php

namespace Keep\Entities\Observers;

use Keep\Entities\Role;

class RoleObserver
{
    public function deleting(Role $role)
    {
        if (!method_exists($role, 'bootSoftDeletes')) {
            $role->users()->sync([]);
            $role->permissions()->sync([]);
        }
    }
}