<?php

use Carbon\Carbon;
use Keep\Entities\Notification;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NotificationEntityTest extends ModelTestCase
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
}
