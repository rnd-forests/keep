<?php

use Keep\Entities\Permission;

class PermissionEntityTest extends ModelTestCase
{
    public function testBelongsToManyRoles()
    {
        $this->assertBelongsToMany('roles', Permission::class);
    }
}
