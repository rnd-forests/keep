<?php
namespace Keep\Repositories\Priority;

use Keep\Entities\User;
use Keep\Entities\Priority;
use Keep\Repositories\DbRepository;

class EloquentPriorityRepository extends DbRepository implements PriorityRepositoryInterface
{
    protected $model;

    public function __construct(Priority $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model
            ->latest('value')
            ->get(['id', 'name']);
    }

    public function lists()
    {
        return $this->model
            ->latest('value')
            ->lists('name', 'id');
    }

    public function findByName($name)
    {
        return $this->model
            ->where('name', $name)
            ->firstOrFail();
    }

    public function getTasksOfUserAssociatedWithAPriority($userSlug, $priorityName, $limit)
    {
        $user = User::findBySlug($userSlug);
        $priority = $this->findByName($priorityName);

        return $user->tasks()
            ->latest('created_at')
            ->where('priority_id', $priority->id)
            ->paginate($limit);
    }
}