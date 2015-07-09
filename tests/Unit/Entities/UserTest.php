<?php

class UserTest extends TestCase
{
    /** @test */
    public function it_belongs_to_many_roles()
    {
        $this->assertBelongsToMany('roles', 'Keep\Entities\User');
    }

    /** @test */
    public function it_has_only_one_profile()
    {
        $this->assertHasOne('profile', 'Keep\Entities\User');
    }

    /** @test */
    public function it_has_many_associated_tasks()
    {
        $this->assertHasMany('tasks', 'Keep\Entities\User');
    }

    /** @test */
    public function it_belongs_to_many_notifications()
    {
        $this->assertMorphToMany('notifications', 'Keep\Entities\User');
    }

    /** @test */
    public function it_belongs_to_many_groups()
    {
        $this->assertBelongsToMany('groups', 'Keep\Entities\User');
    }

    /** @test */
    public function it_belongs_to_many_assignments()
    {
        $this->assertMorphToMany('assignments', 'Keep\Entities\User');
    }

    /** @test */
    public function it_has_the_correct_active_state()
    {
        $user = factory('Keep\Entities\User')->make(['active' => 0, 'activation_code' => str_random(60)]);
        $this->assertSame(false, $user->isActive());
    }

    /** @test */
    public function it_has_a_hashed_password_when_this_password_is_set()
    {
        Hash::shouldReceive('make')
            ->once()
            ->andReturn('hashed');
        $user = factory('Keep\Entities\User')->make();
        $this->assertEquals('hashed', $user->password);
    }
}
