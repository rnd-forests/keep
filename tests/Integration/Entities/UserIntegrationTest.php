<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserIntegrationTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_checks_for_correct_administrator_role()
    {
        $owner = factory(Keep\Entities\Role::class)->create(['name' => 'owner']);
        $admin = factory(Keep\Entities\Role::class)->create(['name' => 'admin']);

        $user1 = factory(Keep\Entities\User::class)->create();
        $user1->attachRole($owner);
        $this->assertSame(true, $user1->isAdmin());

        $user2 = factory(Keep\Entities\User::class)->create();
        $user2->attachRoles([$owner, $admin]);
        $this->assertSame(true, $user2->isAdmin());

        $user3 = factory(Keep\Entities\User::class)->create();
        $user3->attachRole($admin);
        $this->assertSame(true, $user3->isAdmin());

        $user4 = factory(Keep\Entities\User::class)->create();
        $this->assertSame(false, $user4->isAdmin());
    }

    /** @test */
    public function it_can_be_notified()
    {
        $user = factory(Keep\Entities\User::class)->create();
        $notification = factory(Keep\Entities\Notification::class)->create();
        $user->notify($notification);
        $this->assertTrue($user->notifications->contains($notification));
    }

    /** @test */
    public function it_has_the_correct_active_state()
    {
        $user = factory(Keep\Entities\User::class)->make(['active' => 0, 'activation_code' => str_random(60)]);
        $this->assertSame(false, $user->isActive());
    }

    /** @test */
    public function it_has_a_hashed_password_when_this_password_is_set()
    {
        Hash::shouldReceive('make')
            ->once()
            ->andReturn('hashed');
        $user = factory(Keep\Entities\User::class)->make();
        $this->assertEquals('hashed', $user->password);
    }
}
