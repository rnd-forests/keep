<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserIntegrationTest extends TestCase
{
    use DatabaseTransactions;

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
}