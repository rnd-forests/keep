<?php namespace Keep\Repositories\Tag;

interface TagRepositoryInterface {

    /**
     * Find a tag by its name.
     *
     * @param $tagName
     *
     * @return mixed
     */
    public function findByName($tagName);

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

    /**
     * Get all tasks of a user that is associated with a given tag.
     *
     * @param $userSlug
     * @param $tagName
     * @param $limit
     *
     * @return mixed
     */
    public function getTasksOfUserAssociatedWithATag($userSlug, $tagName, $limit);

}