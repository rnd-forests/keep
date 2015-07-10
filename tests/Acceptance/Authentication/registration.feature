Feature: Registration
    In order to find a way to manage my personal tasks
    As as customer
    I want to register for a free account on the Keep website

    Scenario: Customer fills out the registration form
        Given I am on the homepage
        And I click link "Register"
        And I fill out the form with all valid values
        Then I should be on the homepage
        And I should see "Check your email address to activate your account."

    Scenario: Customer submits form with all blank fields
        Given I am on registration page
        And I press "Create Account"
        Then I should be redirected back
        And I should see "The name field is required."
        And I should see "The email field is required."
        And I should see "The password field is required."

    Scenario: Customer provides an invalid username
        Given I am on registration page
        And I submitted the form with an invalid username
        Then I should be redirected back
        And I should see "The name may only contain letters and spaces."

    Scenario: Customer provides an invalid email address
        Given I am on registration page
        And I submitted the form with an invalid email address
        Then I should be redirected back
        And I should see "The email must be a valid email address."

    Scenario: Customer provides a too short password
        Given I am on registration page
        And I submitted the form with a too short password
        Then I should be redirected back
        And I should see "The password must be at least 6 characters."

    Scenario: Customer provides an invalid password confirmation
        Given I am on registration page
        And I submitted the form with an unmatched password confirmation
        Then I should be redirected back
        And I should see "The password confirmation does not match."