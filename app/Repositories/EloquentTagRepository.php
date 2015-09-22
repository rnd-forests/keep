<?php

namespace Keep\Repositories;

use Keep\Entities\Tag;
use Keep\Entities\User;
use Keep\Repositories\Contracts\TagRepository;
use Keep\Repositories\Contracts\Common\ShouldBeFound;

class EloquentTagRepository extends AbstractRepository implements
    ShouldBeFound,
    TagRepository
{
    protected $model;

    public function __construct(Tag $model)
    {
        $this->model = $model;
    }

    /**
     * Listing tags by pairs of name and id.
     *
     * @return \Illuminate\Support\Collection
     */
    public function lists()
    {
        return $this->model
            ->oldest('name')
            ->lists('name', 'id');
    }

    /**
     * Fetching tags associated with a user.
     *
     * @param $userSlug
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fetchAttachedTags($userSlug)
    {
        $user = User::findBySlug($userSlug);

        return $this->model
            ->with('tasks')->whereHas('tasks', function ($query) use ($user) {
                $query->user_id = $user->id;
            })->oldest('name')->get();
    }

    /**
     * Fetching tasks associated with a tag.
     *
     * @param $userSlug
     * @param $tagSlug
     * @param $limit
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function associatedTasks($userSlug, $tagSlug, $limit)
    {
        $user = User::findBySlug($userSlug);
        $tag = $this->findBySlug($tagSlug);

        return $tag->tasks()
            ->latest('created_at')
            ->where('user_id', $user->id)
            ->paginate($limit);
    }
}
