<?php
namespace Keep\Commands;

class ConfirmAccountCommand extends Command
{
    public $code;

    public function __construct($code)
    {
        $this->code = $code;
    }
}
