<?php

namespace Keep\Repositories\Contracts;

interface PriorityRepository
{
    /**
     * Fetching all priority levels.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fetchAll();

    /**
     * Listing priority levels by pairs of name and id.
     *
     * @return \Illuminate\Support\Collection
     */
    public function lists();

    /**
     * Find a priority level by its name.
     *
     * @param $name
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findByName($name);

    /**
     * Fetching tasks associated with a priority level.
     *
     * @param $userSlug
     * @param $priorityName
     * @param $limit
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function associatedTasks($userSlug, $priorityName, $limit);
}
