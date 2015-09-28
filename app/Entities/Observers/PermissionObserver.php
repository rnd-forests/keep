<?php

namespace Keep\Entities\Observers;

use Keep\Entities\Permission;

class PermissionObserver
{
    public function deleting(Permission $permission)
    {
        if (!method_exists($permission, 'bootSoftDeletes')) {
            $permission->roles()->sync([]);
        }
    }
}