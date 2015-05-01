<?php namespace Keep\Repositories\Priority;

interface PriorityRepositoryInterface {

    /**
     * List all priority levels.
     *
     * @return mixed
     */
    public function lists();

    /**
     * Find a priority level by its name.
     *
     * @param $priorityName
     *
     * @return mixed
     */
    public function findByName($priorityName);

    /**
     * Get tasks of a user associated with a priority level.
     *
     * @param $userSlug
     * @param $priorityName
     * @param $limit
     *
     * @return mixed
     */
    public function getTasksOfUserAssociatedWithAPriority($userSlug, $priorityName, $limit);

}