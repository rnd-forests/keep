<?php

class GroupTest extends UnitTestCase
{
    /** @test */
    public function it_belongs_to_many_users()
    {
        $this->assertBelongsToMany('users', Keep\Entities\Group::class);
    }

    /** @test */
    public function it_belongs_to_many_notifications()
    {
        $this->assertMorphToMany('notifications', Keep\Entities\Group::class);
    }
}
