<?php namespace Keep\Commands;

class ConfirmAccountCommand extends Command {

    protected $code;

    public function __construct($code)
    {
        $this->code = $code;
    }

    public function getCode()
    {
        return $this->code;
    }

}
