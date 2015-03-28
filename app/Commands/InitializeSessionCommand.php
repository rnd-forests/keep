<?php namespace Keep\Commands;

class InitializeSessionCommand extends Command {

    protected $email, $password, $active, $remember;

    public function __construct($email, $password, $active, $remember)
    {
        $this->email = $email;
        $this->password = $password;
        $this->active = $active;
        $this->remember = $remember;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function getRemember()
    {
        return $this->remember;
    }

}
