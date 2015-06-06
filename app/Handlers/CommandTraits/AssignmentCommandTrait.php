<?php
namespace Keep\Handlers\CommandTraits;

use Keep\Entities\Task;
use Keep\Entities\Assignment;
use Illuminate\Support\Collection;

trait AssignmentCommandTrait
{
    /**
     * Set all possible relations for an assignment and its associated task.
     *
     * @param $command
     * @param $assignment
     * @param $task
     * @param $entities
     */
    public function setRelations($command, $assignment, $task, $entities)
    {
        $this->setTaskTagRelation($task, $command->tagList);
        $this->setAssignmentTaskRelation($task, $assignment);
        $this->setAssignmentPolymorphic($assignment, $entities);
        $this->setTaskPriorityRelation($task, $command->priorityLevel);
    }

    /**
     * Set the task-tag relation.
     *
     * @param Task  $task
     * @param array $tagIds
     */
    public function setTaskTagRelation(Task $task, array $tagIds)
    {
        $this->taskRepo->syncTags($task, $tagIds);
    }

    /**
     * Set the task-priority relation.
     *
     * @param Task $task
     * @param      $priorityId
     */
    public function setTaskPriorityRelation(Task $task, $priorityId)
    {
        $this->taskRepo->associatePriority($task, $priorityId);
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
     * @param       $task
     * @param array $data
     */
    public function updateAssociatedTask($task, array $data)
    {
        $this->taskRepo->adminUpdate($task, $data);
        $this->taskRepo->syncTags($task, $data['tag_list']);
        $this->taskRepo->associatePriority($task, $data['priority_level']);
    }

    /**
     * Sync up polymorphic relations associated with a given assignment.
     *
     * @param $assignment
     * @param $users
     * @param $groups
     */
    public function updatePolymorphicRelations($assignment, $users, $groups)
    {
        $this->assignmentRepo->syncPolymorphicRelations($assignment, $users, $groups);
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
        return [
            'assignment_name' => $command->assignmentName
        ];
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
        return [
            'title'          => $command->title,
            'content'        => $command->content,
            'starting_date'  => $command->startingDate,
            'finishing_date' => $command->finishingDate,
            'location'       => $command->location
        ];
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
        return [
            'title'          => $command->title,
            'content'        => $command->content,
            'starting_date'  => $command->startingDate,
            'finishing_date' => $command->finishingDate,
            'location'       => $command->location,
            'tag_list'       => $command->tagList,
            'priority_level' => $command->priorityLevel
        ];
    }
}