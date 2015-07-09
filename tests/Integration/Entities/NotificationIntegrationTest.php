<?php

use Carbon\Carbon;
use Keep\Entities\Notification;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NotificationIntegrationTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_fetches_old_notifications()
    {
        factory('Keep\Entities\Notification', 1)->create();
        factory('Keep\Entities\Notification', 2)->create(['sent_at' => Carbon::now()->subDays(15)]);
        $this->assertCount(2, Notification::old()->get());
    }

    /** @test */
    public function it_fetches_the_associated_object()
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
     * @test
     * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function it_throws_an_exception_when_the_associated_object_is_not_valid()
    {
        $notification = factory('Keep\Entities\Notification')->create();
        $notification->object_type = 'Keep\Entities\User';
        $notification->object_id = 1000;
        $notification->getObject();
    }
}