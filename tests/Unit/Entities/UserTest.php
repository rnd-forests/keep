<?php

class UserTest extends UnitTestCase
{
    /** @test */
    public function it_has_only_one_profile()
    {
        $this->assertHasOne('profile', Keep\Entities\User::class);
    }

    /** @test */
    public function it_has_many_associated_tasks()
    {
        $this->assertHasMany('tasks', Keep\Entities\User::class);
    }

    /** @test */
    public function it_belongs_to_many_notifications()
    {
        $this->assertMorphToMany('notifications', Keep\Entities\User::class);
    }

    /** @test */
    public function it_belongs_to_many_groups()
    {
        $this->assertBelongsToMany('groups', Keep\Entities\User::class);
    }
}
