<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class SignInTest extends TestCase
{
    use DatabaseTransactions;

    public function testSignInForm()
    {
        factory('Keep\Entities\User')->create(['email' => 'foo@bar.com']);

        $this->visit('/')
            ->click('Login')
            ->seePageIs('/auth/login')
            ->type('foo@bar.com', 'email')
            ->type('secret', 'password')
            ->check('remember')
            ->press('Login')
            ->seePageIs('/')
            ->see('You have been logged in.');

        $this->assertEquals(60, strlen(auth()->user()->remember_token));
    }

    public function testSignInFormFailures()
    {
        factory('Keep\Entities\User')->create(['email' => 'foo@bar.com']);

        $this->visit('/auth/login')
            ->press('Login')
            ->seePageIs('/auth/login')
            ->see('The email field is required')
            ->see('The password field is required');

        $this->visit('/auth/login')
            ->type('foo@bar.com', 'email')
            ->press('Login')
            ->seePageIs('/auth/login')
            ->see('foo@bar.com')
            ->see('The password field is required');

        $this->visit('/auth/login')
            ->type('foo@bar.com', 'email')
            ->type('wrong-password', 'password')
            ->press('Login')
            ->seePageIs('/auth/login')
            ->see('foo@bar.com')
            ->see('Your credentials are wrong or your account has not been activated.');
    }

    public function testSignInFormHelperLinks()
    {
        $this->visit('/auth/login')
            ->click('Reset here')
            ->seePageIs('/auth/password/email');

        $this->visit('/auth/login')
            ->click('Create a free account')
            ->seePageIs('/auth/register');
    }
}