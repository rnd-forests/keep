<?php namespace Keep\Repositories\Priority;

use Keep\User;
use Keep\Priority;

class DbPriorityRepository implements PriorityRepositoryInterface {

    public function all()
    {
        return Priority::with('tasks')->all();
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

    public function getAssociatedPriorities($userSlug)
    {
        $user = User::findBySlug($userSlug);

        return Priority::whereIn('id', $user->tasks()->distinct()->lists('priority_id'))->get();
    }

}