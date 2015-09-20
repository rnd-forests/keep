<?php

namespace Keep\Repositories;

use Keep\Entities\User;
use Keep\Entities\Priority;
use Keep\Repositories\Contracts\PriorityRepository;

class EloquentPriorityRepository extends AbstractRepository
    implements PriorityRepository
{
    protected $model;

    public function __construct(Priority $model)
    {
        $this->model = $model;
    }

    /**
     * Fetching all priority levels.
     *
     * @return mixed
     */
    public function fetchAll()
    {
        return $this->model
            ->latest('value')
            ->get(['id', 'name']);
    }

    /**
     * Listing priority levels by pairs of name and id.
     *
     * @return mixed
     */
    public function lists()
    {
        return $this->model
            ->latest('value')
            ->lists('name', 'id');
    }

    /**
     * Find a priority level by its name.
     *
     * @param $name
     * @return mixed
     */
    public function findByName($name)
    {
        return $this->model
            ->where('name', $name)
            ->firstOrFail();
    }

    /**
     * Fetching tasks associated with a priority level.
     *
     * @param $userSlug
     * @param $priorityName
     * @param $limit
     * @return mixed
     */
    public function associatedTasks($userSlug, $priorityName, $limit)
    {
        $user = User::findBySlug($userSlug);
        $priority = $this->findByName($priorityName);

        return $user->tasks()
            ->latest('created_at')
            ->where('priority_id', $priority->id)
            ->paginate($limit);
    }
}
