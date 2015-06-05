<?php namespace Keep\Repositories\Tag;

use DB;
use Keep\Entities\Tag;
use Keep\Entities\User;
use Keep\Repositories\DbRepository;

class EloquentTagRepository extends DbRepository implements TagRepositoryInterface {

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

    public function getAssociatedTags($userSlug)
    {
        $user = User::findBySlug($userSlug);
        return $this->model->whereIn('id', array_fetch(
            DB::table('tag_task')
                ->whereIn('task_id', $user->tasks->lists('id'))
                ->groupBy('tag_id')
                ->get(), 'tag_id')
        )->get();
    }

    public function getTasksOfUserAssociatedWithATag($userSlug, $tagSlug, $limit)
    {
        $user = User::findBySlug($userSlug);
        $tag = $this->findBySlug($tagSlug);
        return $tag->tasks()
            ->latest('created_at')
            ->where('user_id', $user->id)
            ->paginate($limit);
    }

}