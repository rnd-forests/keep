<?php namespace Keep\Handlers\CommandTraits;

use Keep\Task;
use Keep\Assignment;
use Illuminate\Support\Collection;

trait AssignmentCommandTrait {

    /**
     * Set all possible relations.
     *
     * @param $command
     * @param $task
     * @param $assignment
     * @param $taskRepo
     * @param $entities
     */
    public function setRelations($command, $task, $assignment, $taskRepo, $entities)
    {
        $this->setTaskTagRelation($task, $command->tagList, $taskRepo);
        $this->setTaskPriorityRelation($task, $command->priorityLevel, $taskRepo);
        $this->setAssignmentTaskRelation($task, $assignment);
        $this->setAssignmentPolymorphic($assignment, $entities);
    }

    /**
     * Set the task-tag relation.
     *
     * @param Task  $task
     * @param array $tagIds
     * @param       $taskRepo
     */
    public function setTaskTagRelation(Task $task, array $tagIds, $taskRepo)
    {
        $taskRepo->syncTags($task, $tagIds);
    }

    /**
     * Set the task-priority relation.
     *
     * @param Task $task
     * @param      $priorityId
     * @param      $taskRepo
     */
    public function setTaskPriorityRelation(Task $task, $priorityId, $taskRepo)
    {
        $taskRepo->associatePriority($task, $priorityId);
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
     * Set the proper polymorphic associations of assignment.
     *
     * @param Assignment $assignment
     * @param Collection $entities
     */
    public function setAssignmentPolymorphic(Assignment $assignment, Collection $entities)
    {
        $entities->each(function ($entity) use ($assignment)
        {
            $entity->assignments()->attach($assignment->id);
        });
    }

    /**
     * Update the task associated with a given assignment.
     *
     * @param       $task
     * @param       $taskRepo
     * @param array $data
     */
    public function updateAssociatedTask($task, $taskRepo, array $data)
    {
        $taskRepo->adminUpdate($task, $data);

        $taskRepo->syncTags($task, $data['tag_list']);

        $taskRepo->associatePriority($task, $data['priority_level']);
    }

    /**
     * Sync up polymorphic relations associated with a given assignment.
     *
     * @param $assignment
     * @param $assignmentRepo
     * @param $users
     * @param $groups
     */
    public function updatePolymorphicRelations($assignment, $assignmentRepo, $users, $groups)
    {
        $assignmentRepo->syncPolymorphicRelations($assignment, $users, $groups);
    }

    /**
     * Get assignment form request data.
     *
     * @param $command
     *
     * @return array
     */
    public function getAssignmentRequestData($command)
    {
        return array(
            'assignment_name' => $command->assignmentName
        );
    }

    /**
     * Get task form request data.
     *
     * @param $command
     *
     * @return array
     */
    public function getTaskRequestData($command)
    {
        return array(
            'title'          => $command->title,
            'content'        => $command->content,
            'starting_date'  => $command->startingDate,
            'finishing_date' => $command->finishingDate,
            'location'       => $command->location
        );
    }

    /**
     * Get the task form request data together with relations.
     *
     * @param $command
     *
     * @return array
     */
    public function getTaskRequestDataWithRelations($command)
    {
        return array(
            'title'          => $command->title,
            'content'        => $command->content,
            'starting_date'  => $command->startingDate,
            'finishing_date' => $command->finishingDate,
            'location'       => $command->location,
            'tag_list'       => $command->tagList,
            'priority_level' => $command->priorityLevel
        );
    }

}