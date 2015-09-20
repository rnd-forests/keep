<?php

namespace Keep\Repositories\Contracts;

interface TagRepository
{
    /**
     * Listing tags by pairs of name and id.
     *
     * @return mixed
     */
    public function lists();

    /**
     * Fetching tags associated with a user.
     *
     * @param $userSlug
     * @return mixed
     */
    public function fetchAttachedTags($userSlug);

    /**
     * Fetching tasks associated with a tag.
     *
     * @param $userSlug
     * @param $tagSlug
     * @param $limit
     * @return mixed
     */
    public function associatedTasks($userSlug, $tagSlug, $limit);
}
