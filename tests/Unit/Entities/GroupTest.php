<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class GroupTest extends EntityTestCase
{
    use DatabaseTransactions;

    public function testBelongsToManyUsers()
    {
        $this->assertBelongsToMany('users', 'Keep\Entities\Group');
    }

    public function testBelongsToManyAssignments()
    {
        $this->assertMorphToMany('assignments', 'Keep\Entities\Group');
    }

    public function testBelongsToManyNotifications()
    {
        $this->assertMorphToMany('notifications', 'Keep\Entities\Group');
    }

    public function testNotifying()
    {
        $group = factory('Keep\Entities\Group')->create();
        $notification = factory('Keep\Entities\Notification')->create();
        $group->notify($notification);
        $this->assertTrue($group->notifications->contains($notification));
    }
}
