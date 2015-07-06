<?php

use Keep\Entities\Role;
use Keep\Entities\User;
use Keep\Entities\Notification;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserEntityTest extends EntityTestCase
{
    use DatabaseTransactions;

    public function testBelongsToManyRoles()
    {
        $this->assertBelongsToMany('roles', User::class);
    }

    public function testHasOneProfile()
    {
        $this->assertHasOne('profile', User::class);
    }

    public function testHasManyTasks()
    {
        $this->assertHasMany('tasks', User::class);
    }

    public function testBelongsToManyNotifications()
    {
        $this->assertMorphToMany('notifications', User::class);
    }

    public function testBelongsToManyGroups()
    {
        $this->assertBelongsToMany('groups', User::class);
    }

    public function testBelongsToManyAssignments()
    {
        $this->assertMorphToMany('assignments', User::class);
    }

    public function testCheckingForActiveState()
    {
        $user = factory(User::class)->create();
        $this->assertSame(true, $user->isActive());
        $user->update(['active' => false]);
        $this->assertSame(false, $user->isActive());
    }

    public function testCheckingForAdministratorRole()
    {
        $owner = factory(Role::class)->create(['name' => 'owner']);
        $admin = factory(Role::class)->create(['name' => 'admin']);

        $user1 = factory(User::class)->create();
        $user1->attachRole($owner);
        $this->assertSame(true, $user1->isAdmin());

        $user2 = factory(User::class)->create();
        $user2->attachRoles([$owner, $admin]);
        $this->assertSame(true, $user2->isAdmin());

        $user3 = factory(User::class)->create();
        $user3->attachRole($admin);
        $this->assertSame(true, $user3->isAdmin());

        $user4 = factory(User::class)->create();
        $this->assertSame(false, $user4->isAdmin());
    }

    public function testNotifying()
    {
        $user = factory(User::class)->create();
        $notification = factory(Notification::class)->create();
        $user->notify($notification);
        $this->assertTrue($user->notifications->contains($notification));
    }

    public function testHashingPasswordAttributeWhenSet()
    {
        Hash::shouldReceive('make')
            ->once()
            ->andReturn('hashed');
        $user = factory(User::class)->create();
        $this->assertEquals('hashed', $user->password);
    }
}
