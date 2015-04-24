<?php namespace Keep\Commands;

class ModifyAssignmentCommand extends Command {

    public $title;
    public $content;
    public $tagList;
    public $location;
    public $userList;
    public $groupList;
    public $startingDate;
    public $finishingDate;
    public $priorityLevel;
    public $assignmentSlug;
    public $assignmentName;

    public function __construct($title, $content, $tag_list = array(), $location, $user_list = array(),
                                $group_list = array(), $starting_date, $finishing_date, $priority_level,
                                $assignment_slug, $assignment_name)
    {
        $this->title = $title;
        $this->content = $content;
        $this->tagList = $tag_list;
        $this->location = $location;
        $this->userList = $user_list;
        $this->groupList = $group_list;
        $this->startingDate = $starting_date;
        $this->priorityLevel = $priority_level;
        $this->finishingDate = $finishing_date;
        $this->assignmentSlug = $assignment_slug;
        $this->assignmentName = $assignment_name;
    }

}
