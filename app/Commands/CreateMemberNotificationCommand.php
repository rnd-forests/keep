<?php
namespace Keep\Commands;

class CreateMemberNotificationCommand extends Command
{
    public $type;
    public $body;
    public $subject;
    public $userList;

    public function __construct($type, $body, $subject, $user_list)
    {
        $this->type = $type;
        $this->body = $body;
        $this->subject = $subject;
        $this->userList = $user_list;
    }
}
