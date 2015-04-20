<?php namespace Keep\Commands;

class CreateMemberAssignmentCommand extends Command {

    public $title;
    public $content;
    public $tagList;
    public $userList;
    public $location;
    public $startingDate;
    public $finishingDate;
    public $priorityLevel;
    public $assignmentName;

    public function __construct($assignment_name, $title, $content, $user_list, $starting_date,
                                $finishing_date, $location, $tag_list = array(), $priority_level)
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
