<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends EntityTestCase
{
    use DatabaseTransactions;

    public function testBelongsToManyRoles()
    {
        $this->assertBelongsToMany('roles', 'Keep\Entities\User');
    }

    public function testHasOneProfile()
    {
        $this->assertHasOne('profile', 'Keep\Entities\User');
    }

    public function testHasManyTasks()
    {
        $this->assertHasMany('tasks', 'Keep\Entities\User');
    }

    public function testBelongsToManyNotifications()
    {
        $this->assertMorphToMany('notifications', 'Keep\Entities\User');
    }

    public function testBelongsToManyGroups()
    {
        $this->assertBelongsToMany('groups', 'Keep\Entities\User');
    }

    public function testBelongsToManyAssignments()
    {
        $this->assertMorphToMany('assignments', 'Keep\Entities\User');
    }

    public function testCheckingForActiveState()
    {
        $user = factory('Keep\Entities\User')->create();
        $this->assertSame(true, $user->isActive());
        $user->update(['active' => false]);
        $this->assertSame(false, $user->isActive());
    }

    public function testCheckingForAdministratorRole()
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

    public function testNotifying()
    {
        $user = factory('Keep\Entities\User')->create();
        $notification = factory('Keep\Entities\Notification')->create();
        $user->notify($notification);
        $this->assertTrue($user->notifications->contains($notification));
    }

    public function testHashingPasswordAttributeWhenSet()
    {
        Hash::shouldReceive('make')
            ->once()
            ->andReturn('hashed');
        $user = factory('Keep\Entities\User')->create();
        $this->assertEquals('hashed', $user->password);
    }
}
