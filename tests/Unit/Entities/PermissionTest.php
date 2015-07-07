<?php

class PermissionTest extends EntityTestCase
{
    public function testBelongsToManyRoles()
    {
        $this->assertBelongsToMany('roles', 'Keep\Entities\Permission');
    }
}
