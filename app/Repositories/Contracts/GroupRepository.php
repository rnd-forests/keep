<?php

namespace Keep\Repositories\Contracts;

interface GroupRepository
{
    /**
     * Fetching trashed groups.
     *
     * @param $limit
     * @return mixed
     */
    public function trashed($limit);

    /**
     * Finding a trashed group.
     *
     * @param $slug
     * @return mixed
     */
    public function findTrashedGroup($slug);

    /**
     * Finding associated users of a group.
     *
     * @param $group
     * @param $limit
     * @return mixed
     */
    public function associatedUsers($group, $limit);

    /**
     * Finding users who do not belong to a group.
     *
     * @param $slug
     * @return mixed
     */
    public function outsiders($slug);

    /**
     * Adding users to a group.
     *
     * @param $group
     * @param array $users
     * @return mixed
     */
    public function attachUsers($group, array $users);

    /**
     * Fetching a collection of users using an array of ids.
     *
     * @param array $ids
     * @return mixed
     */
    public function fetchByIds(array $ids);

    /**
     * Fetching groups of a user.
     *
     * @param $userSlug
     * @return mixed
     */
    public function joinedGroups($userSlug);

    /**
     * Fetching members of a group.
     *
     * @param $groupSlug
     * @return mixed
     */
    public function fetchMembers($groupSlug);
}
