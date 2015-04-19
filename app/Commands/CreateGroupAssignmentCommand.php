<?php namespace Keep\Commands;

class CreateGroupAssignmentCommand extends Command {

    public $title;
    public $content;
    public $tagList;
    public $location;
    public $groupList;
    public $startingDate;
    public $finishingDate;
    public $priorityLevel;
    public $assignmentName;

    public function __construct($assignment_name, $title, $content, $group_list, $starting_date,
                                $finishing_date, $location, $tag_list = array(), $priority_level)
    {
        $this->assignmentName = $assignment_name;
        $this->title = $title;
        $this->content = $content;
        $this->groupList = $group_list;
        $this->startingDate = $starting_date;
        $this->finishingDate = $finishing_date;
        $this->location = $location;
        $this->tagList = $tag_list;
        $this->priorityLevel = $priority_level;
    }

}
