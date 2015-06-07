<?php
namespace Keep\Commands;

class ConfirmAccount extends Command
{
    public $code;

    public function __construct($code)
    {
        $this->code = $code;
    }
}
