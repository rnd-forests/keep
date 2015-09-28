<?php

namespace Keep\Entities\Observers;

use Keep\Entities\Permission;

class PermissionObserver
{
    /**
     * Hook into permission deleting event.
     *
     * @param Permission $permission
     */
    public function deleting(Permission $permission)
    {
        if (!method_exists($permission, 'bootSoftDeletes')) {
            $permission->roles()->sync([]);
        }
    }
}