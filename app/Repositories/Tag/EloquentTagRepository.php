<?php
namespace Keep\Repositories\Tag;

use Keep\Entities\Tag;
use Keep\Entities\User;
use Keep\Repositories\EloquentRepository;

class EloquentTagRepository extends EloquentRepository implements TagRepositoryInterface
{
    protected $model;

    public function __construct(Tag $model)
    {
        $this->model = $model;
    }

    public function lists()
    {
        return $this->model
            ->oldest('name')
            ->lists('name', 'id');
    }

    public function fetchAttachedTags($userSlug)
    {
        $user = User::findBySlug($userSlug);

        return $this->model
            ->with('tasks')->whereHas('tasks', function ($query) use ($user) {
                $query->user_id = $user->id;
            })->get();
    }

    public function fetchTasksAssociatedWithTag($userSlug, $tagSlug, $limit)
    {
        $user = User::findBySlug($userSlug);
        $tag = $this->findBySlug($tagSlug);

        return $tag->tasks()
            ->latest('created_at')
            ->where('user_id', $user->id)
            ->paginate($limit);
    }
}
