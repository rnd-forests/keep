<?php

class FormLinksTest extends TestCase
{
    public function testRegistrationFormLinks()
    {
        $this->visit('auth/register')
            ->click('Login here')
            ->seePageIs('auth/login');
    }

    public function testLoginFormLinks()
    {
        $this->visit('auth/login')
            ->click('Reset here')
            ->seePageIs('auth/password/email')
            ->click('Create a free account')
            ->seePageIs('auth/register');
    }

    public function testPasswordRecoveryFormLinks()
    {
        $this->visit('auth/password/email')
            ->click('Login')
            ->seePageIs('auth/login')
            ->click('Create a free account')
            ->seePageIs('auth/register');
    }
}
