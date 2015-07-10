<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Behat\Gherkin\Node\PyStringNode;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Behat\Context\SnippetAcceptingContext;
use Laracasts\Behat\Context\DatabaseTransactions;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context, SnippetAcceptingContext
{
    use DatabaseTransactions;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given I am on registration page
     */
    public function iAmOnRegistrationPage()
    {
        $this->visitPath('auth/register');
    }

    /**
     * @Given I fill out the form with all valid values
     */
    public function iFillOutTheFormWithAllValidValues()
    {
        $this->fillField('name', 'Vinh Nguyen');
        $this->fillField('email', 'vinhnguyen@hust.com');
        $this->fillField('password', 'secret');
        $this->fillField('password_confirmation', 'secret');
        $this->pressButton('Create Account');
    }

    /**
     * @Given I submitted the form with an unmatched password confirmation
     */
    public function iSubmittedTheFormWithAnUnmatchedPasswordConfirmation()
    {
        $this->fillField('name', 'Vinh Nguyen');
        $this->fillField('email', 'vinhnguyen@hust.com');
        $this->fillField('password', 'secret');
        $this->fillField('password_confirmation', 'secret-secret');
        $this->pressButton('Create Account');
    }

    /**
     * @Given I submitted the form with an invalid username
     */
    public function iSubmittedTheFormWithAnInvalidUsername()
    {
        $this->fillField('name', 'Vinh Nguyen 111');
        $this->pressButton('Create Account');
    }

    /**
     * @Given I submitted the form with an invalid email address
     */
    public function iSubmittedTheFormWithAnInvalidEmailAddress()
    {
        $this->fillField('email', 'foo@bar');
        $this->pressButton('Create Account');
    }

    /**
     * @Given I submitted the form with a too short password
     */
    public function iSubmittedTheFormWithATooShortPassword()
    {
        $this->fillField('password', '123');
        $this->fillField('password_confirmation', '123');
        $this->pressButton('Create Account');
    }

    /**
     * @Given I click link :link
     * @param $link
     */
    public function iClickLink($link)
    {
        $this->clickLink($link);
    }

    /**
     * @Then I should be redirected back
     */
    public function iShouldBeRedirectedBack()
    {
        $this->getSession()->back();
    }
}
