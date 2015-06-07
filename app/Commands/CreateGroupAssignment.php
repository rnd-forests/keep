<?php
namespace Keep\Commands;

class CreateGroupAssignment extends Command
{
    public $title;
    public $content;
    public $tagList;
    public $location;
    public $groupList;
    public $startingDate;
    public $finishingDate;
    public $priorityLevel;
    public $assignmentName;

    public function __construct($title, $content, $tag_list = [], $location, $group_list,
                                $starting_date, $finishing_date, $priority_level, $assignment_name)
    {
        $this->title = $title;
        $this->content = $content;
        $this->tagList = $tag_list;
        $this->location = $location;
        $this->groupList = $group_list;
        $this->startingDate = $starting_date;
        $this->priorityLevel = $priority_level;
        $this->finishingDate = $finishing_date;
        $this->assignmentName = $assignment_name;
    }
}
