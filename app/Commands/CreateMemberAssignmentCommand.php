<?php
namespace Keep\Commands;

class CreateMemberAssignmentCommand extends Command
{
    public $title;
    public $content;
    public $tagList;
    public $userList;
    public $location;
    public $startingDate;
    public $finishingDate;
    public $priorityLevel;
    public $assignmentName;

    public function __construct($title, $content, $tag_list = [], $location, $user_list,
                                $starting_date, $finishing_date, $priority_level, $assignment_name)
    {
        $this->title = $title;
        $this->content = $content;
        $this->tagList = $tag_list;
        $this->location = $location;
        $this->userList = $user_list;
        $this->startingDate = $starting_date;
        $this->finishingDate = $finishing_date;
        $this->priorityLevel = $priority_level;
        $this->assignmentName = $assignment_name;
    }
}
