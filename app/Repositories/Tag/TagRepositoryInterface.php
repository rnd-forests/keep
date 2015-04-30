<?php namespace Keep\Repositories\Tag;

interface TagRepositoryInterface {

    /**
     * List all the tags.
     *
     * @return mixed
     */
    public function lists();

    /**
     * Get all tags associated with a user's tasks.
     *
     * @param $userSlug
     *
     * @return mixed
     */
    public function getAssociatedTags($userSlug);

}