<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseTransactions;

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
        $user = factory('Keep\Entities\User')->create();
        $this->assertSame(true, $user->isActive());
        $user->update(['active' => false]);
        $this->assertSame(false, $user->isActive());
    }

    /** @test */
    public function it_checks_for_correct_administrator_role()
    {
        $owner = factory('Keep\Entities\Role')->create(['name' => 'owner']);
        $admin = factory('Keep\Entities\Role')->create(['name' => 'admin']);

        $user1 = factory('Keep\Entities\User')->create();
        $user1->attachRole($owner);
        $this->assertSame(true, $user1->isAdmin());

        $user2 = factory('Keep\Entities\User')->create();
        $user2->attachRoles([$owner, $admin]);
        $this->assertSame(true, $user2->isAdmin());

        $user3 = factory('Keep\Entities\User')->create();
        $user3->attachRole($admin);
        $this->assertSame(true, $user3->isAdmin());

        $user4 = factory('Keep\Entities\User')->create();
        $this->assertSame(false, $user4->isAdmin());
    }

    /** @test */
    public function it_can_be_notified()
    {
        $user = factory('Keep\Entities\User')->create();
        $notification = factory('Keep\Entities\Notification')->create();
        $user->notify($notification);
        $this->assertTrue($user->notifications->contains($notification));
    }

    /** @test */
    public function it_has_a_hashed_password_when_this_password_is_set()
    {
        Hash::shouldReceive('make')
            ->once()
            ->andReturn('hashed');
        $user = factory('Keep\Entities\User')->create();
        $this->assertEquals('hashed', $user->password);
    }
}
