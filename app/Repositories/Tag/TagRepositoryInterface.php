<?php namespace Keep\Repositories\Tag;

interface TagRepositoryInterface {

    public function lists();

    public function getAssociatedTags($userSlug);

    public function getTasksOfUserAssociatedWithATag($userSlug, $tagSlug, $limit);

}