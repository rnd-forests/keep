<?php

use Keep\Entities\Permission;

class PermissionEntityTest extends EntityTestCase
{
    public function testBelongsToManyRoles()
    {
        $this->assertBelongsToMany('roles', Permission::class);
    }
}
