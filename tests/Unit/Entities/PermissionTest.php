<?php

class PermissionTest extends TestCase
{
    /** @test */
    public function it_belongs_to_many_roles()
    {
        $this->assertBelongsToMany('roles', 'Keep\Entities\Permission');
    }
}
