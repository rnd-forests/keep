<?php

class PermissionTest extends EntityTestCase
{
    /** @test */
    public function it_belongs_to_many_roles()
    {
        $this->assertBelongsToMany('roles', 'Keep\Entities\Permission');
    }
}
