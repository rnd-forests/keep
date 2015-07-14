<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsersControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected $mock, $user;

    /**
     * @before
     */
    public function it_initializes_testing_environment()
    {
        $this->mock = $this->mock('Keep\Repositories\User\UserRepositoryInterface');
        $this->user = $this->setAuthenticatedUser();
    }

    /** @test */
    public function it_shows_the_profile_of_the_user()
    {
        $this->mock->shouldReceive('findBySlug')->atLeast()->once()->andReturn($this->user);

        $this->route('GET', 'member::profile', ['users' => $this->user->slug]);

        $this->assertResponseOk();
        $this->assertViewIs('users.show');
        $this->assertViewHas('user', $this->user);
    }

    /** @test */
    public function it_updates_user_profile()
    {
        $this->withoutMiddleware();
        $slug = $this->user->slug;
        $currentUrl = route('member::profile', $this->user);
        $input = ["github_username" => "fizz", "facebook_username" => "buzz"];
        $this->mock->shouldReceive('updateProfile')->with($input, $slug)->once();

        $this->route('PATCH', 'member::update', ['users' => $slug], $input, [], [], ['HTTP_REFERER' => $currentUrl]);

        $this->assertResponseStatus(302);
        $this->assertKeyTranslated('controller.profile_updated');
        $this->assertRedirectedToRoute('member::profile', ['users' => $slug]);
    }

    /** @test */
    public function it_fails_to_update_user_profile()
    {
        $this->withoutMiddleware();
        $input = ['phone' => '12345abc'];
        $this->mock->shouldReceive('updateProfile')->never();

        $this->route('PATCH', 'member::update', ['users' => $this->user->slug], $input);

        $this->assertSessionHasErrors(['phone' => 'The phone format is invalid.']);
    }

    /** @test */
    public function it_cancels_the_account_of_the_user()
    {
        $this->withoutMiddleware();
        $this->mock->shouldReceive('softDelete')->with($this->user->slug)->once();

        $this->route('DELETE', 'member::destroy', ['users' => $this->user->slug]);

        $this->assertFlashedMessage();
        $this->assertKeyTranslated('controller.account_canceled');
        $this->assertRedirectedToRoute('home');
    }
}