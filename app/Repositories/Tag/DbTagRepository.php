<?php namespace Keep\Repositories\Tag;

use DB;
use Keep\Tag;
use Keep\User;

class DbTagRepository implements TagRepositoryInterface {

    public function findByName($tagName)
    {
        return Tag::whereName($tagName)->firstOrFail();
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

    public function getTasksOfUserAssociatedWithATag($userSlug, $tagName, $limit)
    {
        $user = User::findBySlug($userSlug);

        $tag = $this->findByName($tagName);

        return $tag->tasks()->orderBy('created_at', 'desc')->where('user_id', $user->id)->paginate($limit);
    }

}