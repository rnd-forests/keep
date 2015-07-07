<?php

class RoleTest extends EntityTestCase
{
    /** @test */
    public function it_belongs_to_many_permissions()
    {
        $this->assertBelongsToMany('perms', 'Keep\Entities\Role');
    }

    /** @test */
    public function it_belongs_to_many_users()
    {
        $this->assertBelongsToMany('users', 'Keep\Entities\Role');
    }
}
