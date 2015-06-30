<?php

use Keep\Entities\Group;
use Keep\Entities\Notification;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GroupEntityTest extends EntityTestCase
{
    use DatabaseTransactions;

    public function testBelongsToManyUsers()
    {
        $this->assertBelongsToMany('users', Group::class);
    }

    public function testBelongsToManyAssignments()
    {
        $this->assertMorphToMany('assignments', Group::class);
    }

    public function testBelongsToManyNotifications()
    {
        $this->assertMorphToMany('notifications', Group::class);
    }

    public function testNotifying()
    {
        $group = factory(Group::class)->create();
        $notification = factory(Notification::class)->create();
        $group->notify($notification);
        $this->assertContainsOnlyInstancesOf(Notification::class, $group->notifications);
        $this->assertTrue($group->notifications->contains($notification));
    }
}
