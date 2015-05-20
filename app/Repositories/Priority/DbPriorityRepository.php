<?php namespace Keep\Repositories\Priority;

use Keep\Entities\User;
use Keep\Entities\Priority;

class DbPriorityRepository implements PriorityRepositoryInterface {

    public function all()
    {
        return Priority::orderBy('value', 'desc')->get(['id', 'name']);
    }

    public function lists()
    {
        return Priority::orderBy('value', 'desc')->lists('name', 'id');
    }

    public function findByName($priorityName)
    {
        return Priority::whereName($priorityName)->firstOrFail();
    }

    public function getTasksOfUserAssociatedWithAPriority($userSlug, $priorityName, $limit)
    {
        $user = User::findBySlug($userSlug);

        $priority = $this->findByName($priorityName);

        return $user->tasks()->orderBy('created_at', 'desc')->where('priority_id', $priority->id)->paginate($limit);
    }

}