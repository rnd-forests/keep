<?php

namespace Keep\Repositories\Contracts;

interface TagRepositoryInterface
{
    public function findBySlug($slug);
    public function lists();
    public function fetchAttachedTags($userSlug);
    public function fetchTasksAssociatedWithTag($userSlug, $tagSlug, $limit);
}
