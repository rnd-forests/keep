<?php

use Keep\Entities\Role;

class RoleEntityTest extends EntityTestCase
{
    public function testBelongsToManyPermissions()
    {
        $this->assertBelongsToMany('perms', Role::class);
    }

    public function testBelongsToManyUsers()
    {
        $this->assertBelongsToMany('users', Role::class);
    }
}
