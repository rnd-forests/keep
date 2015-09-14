<?php

namespace Keep\Repositories\Contracts;

interface TagRepositoryInterface
{
    public function lists();
    public function fetchAttachedTags($userSlug);
    public function associatedTasks($userSlug, $tagSlug, $limit);
}
