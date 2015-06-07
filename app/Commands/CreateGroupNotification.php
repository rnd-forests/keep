<?php
namespace Keep\Commands;

class CreateGroupNotification extends Command
{
    public $type;
    public $body;
    public $subject;
    public $groupList;

    public function __construct($type, $body, $subject, $group_list)
    {
        $this->type = $type;
        $this->body = $body;
        $this->subject = $subject;
        $this->groupList = $group_list;
    }
}
