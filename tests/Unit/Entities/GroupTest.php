<?php

class GroupTest extends TestCase
{
    /** @test */
    public function it_belongs_to_many_users()
    {
        $this->assertBelongsToMany('users', 'Keep\Entities\Group');
    }

    /** @test */
    public function it_belongs_to_many_assignments()
    {
        $this->assertMorphToMany('assignments', 'Keep\Entities\Group');
    }

    /** @test */
    public function it_belongs_to_many_notifications()
    {
        $this->assertMorphToMany('notifications', 'Keep\Entities\Group');
    }
}
