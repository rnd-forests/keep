<?php

namespace Keep\Repositories\Contracts;

interface PriorityRepository
{
    /**
     * Fetching all priority levels.
     *
     * @return mixed
     */
    public function fetchAll();

    /**
     * Listing priority levels by pairs of name and id.
     *
     * @return mixed
     */
    public function lists();

    /**
     * Find a priority level by its name.
     *
     * @param $name
     * @return mixed
     */
    public function findByName($name);

    /**
     * Fetching tasks associated with a priority level.
     *
     * @param $userSlug
     * @param $priorityName
     * @param $limit
     * @return mixed
     */
    public function associatedTasks($userSlug, $priorityName, $limit);
}
