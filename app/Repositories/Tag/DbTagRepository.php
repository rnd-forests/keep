<?php namespace Keep\Repositories\Tag;

use DB;
use Keep\Entities\Tag;
use Keep\Entities\User;

class DbTagRepository implements TagRepositoryInterface {

    public function findBySlug($tagSlug)
    {
        return Tag::whereSlug($tagSlug)->firstOrFail();
    }

    public function lists()
    {
        return Tag::orderBy('name', 'asc')->lists('name', 'id');
    }

    public function getAssociatedTags($userSlug)
    {
        $user = User::findBySlug($userSlug);

        return Tag::whereIn('id', array_fetch(
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

        return $tag->tasks()->orderBy('created_at', 'desc')->where('user_id', $user->id)->paginate($limit);
    }

}