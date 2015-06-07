<?php
namespace Keep\Commands;

class InitializeUserSession extends Command
{
    public $email;
    public $password;
    public $active;
    public $remember;

    public function __construct($email, $password, $active, $remember)
    {
        $this->email = $email;
        $this->password = $password;
        $this->active = $active;
        $this->remember = $remember;
    }
}
