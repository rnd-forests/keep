<?php

namespace Keep\Repositories\Contracts;

interface TagRepository
{
    /**
     * Listing tags by pairs of name and id.
     *
     * @return \Illuminate\Support\Collection
     */
    public function lists();

    /**
     * Fetching tags associated with a user.
     *
     * @param $userSlug
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fetchAttachedTags($userSlug);

    /**
     * Fetching tasks associated with a tag.
     *
     * @param $userSlug
     * @param $tagSlug
     * @param $limit
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function associatedTasks($userSlug, $tagSlug, $limit);
}
