<?php

use Keep\Entities\Role;

class RoleEntityTest extends ModelTestCase
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
