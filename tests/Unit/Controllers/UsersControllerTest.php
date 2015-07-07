<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsersControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected $mock, $user;

    /**
     * @before
     */
    public function initializeEnv()
    {
        $this->mock = $this->mock('Keep\Repositories\User\UserRepositoryInterface');
        $this->user = factory('Keep\Entities\User')->create();
        $this->actingAs($this->user);
    }

    public function testShowUserProfile()
    {
        $this->mock->shouldReceive('findBySlug')->atLeast()->andReturn($this->user);

        $this->route('GET', 'member::profile', ['users' => $this->user->slug]);

        $this->assertResponseOk();
        $this->assertViewIs('users.show');
        $this->assertViewHas('user', $this->user);
    }

//    public function testUpdateUserProfile()
//    {
//        $this->withoutMiddleware();
//        $input = [
//            '_method'  => 'patch',
//            '_token'   => 'token',
//            'location' => 'foo',
//            'bio'      => 'bar'
//        ];
//        Input::replace($input);
//        $this->mock->shouldReceive('updateProfile')->with($input, $this->user->slug)->once();
//
//        $this->route('PUT', 'member::update', ['users' => $this->user->slug]);
//
//        $this->assertResponseOk();
//        $this->assertKeyTranslated('controller.profile_updated');
//        $this->assertRedirectedToRoute('member::profile');
//    }

    public function testDestroyUserAccount()
    {
        $this->withoutMiddleware();
        $this->mock->shouldReceive('softDelete')->with($this->user->slug)->once();

        $this->route('DELETE', 'member::destroy', ['users' => $this->user->slug]);

        $this->assertFlashedMessage();
        $this->assertKeyTranslated('controller.account_canceled');
        $this->assertRedirectedToRoute('home');
    }
}
