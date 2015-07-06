<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegistrationFormTest extends TestCase
{
    use DatabaseTransactions;

    public function testApplicationRegistrationForm()
    {
        $this->visit('/')
            ->click('Register')
            ->seePageIs('auth/register')
            ->type('Anonymous', 'name')
            ->type('anonymous.secret@gmail.com', 'email')
            ->type('secret', 'password')
            ->type('secret', 'password_confirmation')
            ->press('Create Account')
            ->seePageIs('/');

        $this->seeInDatabase('users', [
            'email' => 'anonymous.secret@gmail.com',
            'name' => 'Anonymous'
        ]);
    }
}
