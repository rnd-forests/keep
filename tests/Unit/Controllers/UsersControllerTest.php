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
        $this->user = factory('Keep\Entities\User')->create();
        $this->actingAs($this->user);
    }

    /** @test */
    public function it_shows_the_profile_of_the_user()
    {
        $this->mock->shouldReceive('findBySlug')->atLeast()->andReturn($this->user);

        $this->route('GET', 'member::profile', ['users' => $this->user->slug]);

        $this->assertResponseOk();
        $this->assertViewIs('users.show');
        $this->assertViewHas('user', $this->user);
    }

    public function testUpdateUserProfile()
    {
        $this->withoutMiddleware();
        $input = [
            '_method'  => 'patch',
            '_token'   => 'token',
            'location' => 'foo',
            'bio'      => 'bar'
        ];
        Input::replace($input);
        $this->mock->shouldReceive('updateProfile')->with($input, $this->user->slug)->once()->andReturn(true);

        $this->route('PATCH', 'member::update', ['users' => $this->user->slug]);

        $this->assertResponseOk();
        $this->assertKeyTranslated('controller.profile_updated');
        $this->assertRedirectedToRoute('member::profile');
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
