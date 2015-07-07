<?php

use Carbon\Carbon;
use Keep\Entities\Notification;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NotificationTest extends EntityTestCase
{
    use DatabaseTransactions;

    public function testBelongsToManyUsers()
    {
        $this->assertMorphedByMany('users', 'Keep\Entities\Notification');
    }

    public function testBelongsToManyGroups()
    {
        $this->assertMorphedByMany('groups', 'Keep\Entities\Notification');
    }

    public function testFetchingOldNotifications()
    {
        factory('Keep\Entities\Notification', 2)->create();
        factory('Keep\Entities\Notification', 3)->create(['sent_at' => Carbon::now()->subDays(15)]);
        $this->assertCount(5, Notification::get());
        $this->assertCount(3, Notification::old()->get());
    }

    public function testGetsObject()
    {
        $user = factory('Keep\Entities\User')->create();
        $notification = factory('Keep\Entities\Notification')->create();
        $notification->object_type = 'Keep\Entities\User';
        $notification->object_id = $user->id;
        $this->assertEquals($user->id, $notification->getObject()->id);
        $notification->object_id = 100;
        $this->assertNull($notification->attachedObject);
    }

    /**
     * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function testGetsObjectException()
    {
        $notification = factory('Keep\Entities\Notification')->create();
        $notification->object_type = 'Keep\Entities\User';
        $notification->object_id = 1000;
        $notification->getObject();
    }
}
