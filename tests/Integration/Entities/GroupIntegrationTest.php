<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class GroupIntegrationTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_can_be_notified()
    {
        $group = factory(Keep\Entities\Group::class)->create();
        $notification = factory(Keep\Entities\Notification::class)->create();
        $group->notify($notification);
        $this->assertTrue($group->notifications->contains($notification));
    }
}
