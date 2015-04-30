<?php namespace Keep\Repositories\Tag;

use DB;
use Keep\Tag;
use Keep\User;

class DbTagRepository implements TagRepositoryInterface {

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

}