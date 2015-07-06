<?php

use Carbon\Carbon;
use Keep\Entities\User;
use Keep\Entities\Notification;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NotificationEntityTest extends EntityTestCase
{
    use DatabaseTransactions;

    public function testBelongsToManyUsers()
    {
        $this->assertMorphedByMany('users', Notification::class);
    }

    public function testBelongsToManyGroups()
    {
        $this->assertMorphedByMany('groups', Notification::class);
    }

    public function testFetchingOldNotifications()
    {
        factory(Notification::class, 2)->create();
        factory(Notification::class, 3)->create(['sent_at' => Carbon::now()->subDays(15)]);
        $this->assertCount(5, Notification::get());
        $this->assertCount(3, Notification::old()->get());
    }

    public function testGetsObject()
    {
        $user = factory(User::class)->create();
        $notification = factory(Notification::class)->create();
        $notification->object_type = User::class;
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
        $notification = factory(Notification::class)->create();
        $notification->object_type = User::class;
        $notification->object_id = 1000;
        $notification->getObject();
    }
}
