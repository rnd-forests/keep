<?php

namespace Keep\Repositories\Tag;

interface TagRepositoryInterface
{
    public function lists();

    public function fetchAttachedTags($userSlug);

    public function fetchTasksAssociatedWithTag($userSlug, $tagSlug, $limit);
}
