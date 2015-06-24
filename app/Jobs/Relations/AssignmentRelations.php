<?php
namespace Keep\Jobs\Relations;

use Keep\Jobs\Job;
use Keep\Entities\Task;
use Keep\Entities\Assignment;
use Illuminate\Support\Collection;
use Keep\Repositories\Task\TaskRepositoryInterface;
use Keep\Repositories\User\UserRepositoryInterface;
use Keep\Repositories\UserGroup\UserGroupRepositoryInterface;
use Keep\Repositories\Assignment\AssignmentRepositoryInterface;

abstract class AssignmentRelations extends Job
{
    protected $data;
    protected static $taskRepo, $assignmentRepo, $userRepo, $groupRepo;

    /**
     * Constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
        self::$userRepo = app()->make(UserRepositoryInterface::class);
        self::$taskRepo = app()->make(TaskRepositoryInterface::class);
        self::$groupRepo = app()->make(UserGroupRepositoryInterface::class);
        self::$assignmentRepo = app()->make(AssignmentRepositoryInterface::class);
    }

    /**
     * Set all possible relations for an assignment and its associated task.
     *
     * @param $assignment
     * @param $task
     * @param $entities
     */
    public function setRelations($assignment, $task, $entities)
    {
        $this->setTaskTagRelation($task);
        $this->setAssignmentTaskRelation($task, $assignment);
        $this->setAssignmentPolymorphic($assignment, $entities);
        $this->setTaskPriorityRelation($task);
    }

    /**
     * Set the task-tag relation.
     *
     * @param Task $task
     */
    public function setTaskTagRelation(Task $task)
    {
        self::$taskRepo->syncTags($task, $this->getTagListRequestData());
    }

    /**
     * Set the task-priority relation.
     *
     * @param Task $task
     */
    public function setTaskPriorityRelation(Task $task)
    {
        self::$taskRepo->associatePriority($task, $this->getPriorityRequestData());
    }

    /**
     * Set the assignment-task relation.
     *
     * @param $task
     * @param $assignment
     *
     * @return bool
     */
    public function setAssignmentTaskRelation(Task $task, Assignment $assignment)
    {
        $task->assignment()->associate($assignment);
        $task->is_assigned = true;

        return $task->save();
    }

    /**
     * Set the proper polymorphic associations of an assignment.
     *
     * @param Assignment $assignment
     * @param Collection $entities
     */
    public function setAssignmentPolymorphic(Assignment $assignment, Collection $entities)
    {
        $entities->each(function ($entity) use ($assignment) {
            $entity->assignments()->attach($assignment->id);
        });
    }

    /**
     * Update the task associated with a given assignment.
     *
     * @param $task
     */
    public function updateAssociatedTask($task)
    {
        self::$taskRepo->adminUpdate($this->data, $task);
        self::$taskRepo->syncTags($task, $this->getTagListRequestData());
        self::$taskRepo->associatePriority($task, $this->getPriorityRequestData());
    }

    /**
     * Sync up polymorphic relations associated with a given assignment.
     *
     * @param $assignment
     */
    public function updatePolymorphicRelations($assignment)
    {
        self::$assignmentRepo->syncPolymorphicRelations(
            $assignment,
            $this->getUserListRequestData(),
            $this->getGroupListRequestData()
        );
    }


    public function getAssignmentRequestData()
    {
        return [
            'assignment_name' => $this->data['assignment_name']
        ];
    }

    public function getAssignmentSlug()
    {
        return $this->data['assignment_slug'];
    }

    public function getTagListRequestData()
    {
        return array_key_exists('tag_list', $this->data) ? $this->data['tag_list'] : [];
    }

    public function getUserListRequestData()
    {
        return array_key_exists('user_list', $this->data) ? $this->data['user_list'] : [];
    }

    public function getGroupListRequestData()
    {
        return array_key_exists('group_list', $this->data) ? $this->data['group_list'] : [];
    }

    public function getPriorityRequestData()
    {
        return $this->data['priority_level'];
    }

    public function getTaskRequestData()
    {
        return [
            'title'          => $this->data['title'],
            'content'        => $this->data['content'],
            'starting_date'  => $this->data['starting_date'],
            'finishing_date' => $this->data['finishing_date'],
            'location'       => $this->data['location']
        ];
    }

    public function getTaskRequestDataWithRelations()
    {
        return [
            'title'          => $this->data['title'],
            'content'        => $this->data['content'],
            'starting_date'  => $this->data['starting_date'],
            'finishing_date' => $this->data['finishing_date'],
            'location'       => $this->data['location'],
            'tag_list'       => array_key_exists('tag_list', $this->data) ? $this->data['tag_list'] : [],
            'priority_level' => $this->data['priority_level']
        ];
    }
}
