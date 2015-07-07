<?php

class RoleTest extends EntityTestCase
{
    public function testBelongsToManyPermissions()
    {
        $this->assertBelongsToMany('perms', 'Keep\Entities\Role');
    }

    public function testBelongsToManyUsers()
    {
        $this->assertBelongsToMany('users', 'Keep\Entities\Role');
    }
}
