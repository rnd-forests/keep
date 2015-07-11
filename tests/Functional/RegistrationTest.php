<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegistrationTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_creates_a_new_user()
    {
        $this->visit('/')
            ->click('Register')
            ->seePageIs('auth/register')
            ->type('Foo Bar', 'name')
            ->type('foo@bar.com', 'email')
            ->type('123456', 'password')
            ->type('123456', 'password_confirmation')
            ->press('Create Account')
            ->seePageIs('/')
            ->see('Check your email address to activate your account.');

        $this->seeInDatabase('users', ['name' => 'Foo Bar', 'email' => 'foo@bar.com']);
    }

    /** @test */
    public function it_returns_a_warning_message_in_case_the_email_address_has_been_used()
    {
        factory('Keep\Entities\User')->create(['email' => 'foo@bar.com']);

        $this->visit('auth/register')
            ->type('foo@bar.com', 'email')
            ->press('Create Account')
            ->seePageIs('auth/register')
            ->see('The email has already been taken.');
    }

    /** @test */
    public function it_returns_warning_messages_when_no_fields_is_filled_in()
    {
        $this->visit('auth/register')
            ->press('Create Account')
            ->seePageIs('auth/register')
            ->see('The name field is required.')
            ->see('The email field is required.')
            ->see('The password field is required.');
    }

    /** @test */
    public function it_returns_warning_messages_when_required_fields_were_not_filled_in()
    {
        $this->visit('auth/register')
            ->type('Foo', 'name')
            ->type('foo@bar.com', 'email')
            ->press('Create Account')
            ->seePageIs('auth/register')
            ->see('The password field is required.');
    }

    /** @test */
    public function it_returns_warning_message_when_the_name_field_is_not_in_correct_format()
    {
        $this->visit('auth/register')
            ->type('Foo 111', 'name')
            ->press('Create Account')
            ->seePageIs('auth/register')
            ->see('The name may only contain letters and spaces.');
    }

    /** @test */
    public function it_returns_warning_message_when_the_email_field_is_not_in_correct_format()
    {
        $this->visit('auth/register')
            ->type('foo@bar', 'email')
            ->press('Create Account')
            ->seePageIs('auth/register')
            ->see('The email must be a valid email address.');
    }

    /** @test */
    public function it_returns_warning_message_when_the_password_field_is_not_in_correct_format()
    {
        $this->visit('auth/register')
            ->type('12345', 'password')
            ->type('12345', 'password_confirmation')
            ->press('Create Account')
            ->seePageIs('auth/register')
            ->see('The password must be at least 6 characters.');
    }

    /** @test */
    public function it_returns_warning_message_when_the_password_confirmation_field_does_not_match()
    {
        $this->visit('auth/register')
            ->type('123456', 'password')
            ->type('1234567', 'password_confirmation')
            ->press('Create Account')
            ->seePageIs('auth/register')
            ->see('The password confirmation does not match.');
    }

    /** @test */
    public function it_retrieves_old_input_value_in_case_of_failed_form_submission()
    {
        $this->visit('auth/register')
            ->type('Bar', 'name')
            ->type('foo@bar.com', 'email')
            ->press('Create Account')
            ->seePageIs('auth/register')
            ->see('Bar')
            ->see('foo@bar.com')
            ->see('The password field is required.');
    }

    /** @test */
    public function it_contains_valid_helper_links()
    {
        $this->visit('auth/register')
            ->click('Login here')
            ->seePageIs('auth/login');
    }
}