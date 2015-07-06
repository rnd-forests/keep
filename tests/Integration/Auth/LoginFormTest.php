<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginFormTest extends TestCase
{
    use DatabaseTransactions;

    public function testApplicationLoginForm()
    {
        $user = factory(Keep\Entities\User::class)
            ->create()
            ->toArray();

        $this->visit('/')
            ->click('Login')
            ->seePageIs('auth/login')
            ->type($user['email'], 'email')
            ->type('secret', 'password')
            ->check('remember')
            ->press('Login')
            ->seePageIs('/');
    }
}
