<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class SignInTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_authenticates_an_active_user()
    {
        factory(Keep\Entities\User::class)->create(['email' => 'foo@bar.com']);

        $this->visit('/')
            ->click('Sign In')
            ->seePageIs('auth/login')
            ->type('foo@bar.com', 'email')
            ->type('secret', 'password')
            ->check('remember')
            ->press('Sign In')
            ->seePageIs('/');

        $this->assertEquals(60, strlen(auth()->user()->remember_token));
    }

    /** @test */
    public function it_returns_warning_messages_when_no_fields_is_filled_in()
    {
        $this->visit('auth/login')
            ->press('Sign In')
            ->seePageIs('auth/login')
            ->see('The email field is required')
            ->see('The password field is required');
    }

    /** @test */
    public function it_returns_warning_message_when_required_field_is_not_filled_in()
    {
        $this->visit('auth/login')
            ->type('foo@bar.com', 'email')
            ->press('Sign In')
            ->seePageIs('auth/login')
            ->see('foo@bar.com')
            ->see('The password field is required');
    }

    /** @test */
    public function it_returns_an_error_message_when_the_attempting_credentials_are_invalid()
    {
        factory(Keep\Entities\User::class)->create(['email' => 'foo@bar.com']);

        $this->visit('auth/login')
            ->type('foo@bar.com', 'email')
            ->type('wrong-password', 'password')
            ->press('Sign In')
            ->seePageIs('auth/login')
            ->see('foo@bar.com')
            ->see('Your credentials are wrong or your account has not been activated.');
    }

    /** @test */
    public function it_contains_valid_helper_links()
    {
        $this->visit('auth/login')
            ->click('Reset your Password')
            ->seePageIs('auth/password/email');

        $this->visit('auth/login')
            ->click('Sign Up')
            ->seePageIs('auth/register');
    }
}
