<?php namespace Keep\Commands;

class ModifyPasswordCommand extends Command {

    protected $old_password, $new_password;

    public function __construct($old_password, $new_password)
	{
		$this->old_password = $old_password;
        $this->new_password = $new_password;
	}

    public function getOldPassword()
    {
        return $this->old_password;
    }

    public function getNewPassword()
    {
        return $this->new_password;
    }

}
