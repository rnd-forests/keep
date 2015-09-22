<?php

use Keep\Repositories\EloquentUserRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProfileControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected $mock, $user;

    /** @before */
    public function it_initializes_testing_environment()
    {
        $this->mock = $this->mock(EloquentUserRepository::class);
        $this->user = $this->setAuthenticatedUser();
    }

    /** @test */
    public function it_shows_the_profile_of_the_user()
    {
        $this->mock->shouldReceive('findBySlug')
            ->atLeast()
            ->once()
            ->andReturn($this->user);

        $this->route('GET', 'member::profile.show', ['users' => $this->user->slug]);

        $this->assertResponseOk();
        $this->assertViewIs('users.account.profile');
        $this->assertViewHas('user', $this->user);
    }

    /** @test */
    public function it_updates_user_profile()
    {
        $this->withoutMiddleware();
        $slug = $this->user->slug;
        $currentUrl = route('member::profile.show', $this->user);
        $input = ["github_username" => "fizz", "facebook_username" => "buzz"];
        $this->mock->shouldReceive('update')
            ->with($input, $slug)
            ->once();

        $this->route('PATCH', 'member::profile.update', ['users' => $slug], $input,
            [], [], ['HTTP_REFERER' => $currentUrl]);

        $this->assertResponseStatus(302);
        $this->assertFlashedMessage('controller.profile_updated');
        $this->assertRedirectedToRoute('member::profile.show', ['users' => $slug]);
    }

    /** @test */
    public function it_fails_to_update_user_profile()
    {
        $this->withoutMiddleware();
        $input = ['phone' => '12345abc'];
        $this->mock->shouldReceive('updateProfile')->never();

        $this->route('PATCH', 'member::profile.update', ['users' => $this->user->slug], $input);

        $this->assertResponseStatus(302);
        $this->assertSessionHasErrors(['phone' => 'The phone format is invalid.']);
    }

    /** @test */
    public function it_cancels_the_account_of_the_user()
    {
        $this->withoutMiddleware();
        $this->mock->shouldReceive('softDelete')
            ->with($this->user->slug)
            ->once();

        $this->route('DELETE', 'member::account.destroy', ['users' => $this->user->slug]);

        $this->assertResponseStatus(302);
        $this->assertRedirectedToRoute('home');
        $this->assertFlashedMessage('controller.account_canceled');
    }
}
