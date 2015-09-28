<?php

namespace Keep\Core\Repository\Contracts;

interface GroupRepository
{
    /**
     * Fetching trashed groups.
     *
     * @param $limit
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function trashed($limit);

    /**
     * Finding a trashed group.
     *
     * @param $slug
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findTrashedGroup($slug);

    /**
     * Finding associated users of a group.
     *
     * @param $group
     * @param $limit
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function associatedUsers($group, $limit);

    /**
     * Finding users who do not belong to a group.
     *
     * @param $slug
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function outsiders($slug);

    /**
     * Adding users to a group.
     *
     * @param $group
     * @param array $users
     * @return void
     */
    public function attachUsers($group, array $users);

    /**
     * Fetching a collection of users using an array of ids.
     *
     * @param array $ids
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fetchByIds(array $ids);

    /**
     * Fetching groups of a user.
     *
     * @param $userSlug
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function joinedGroups($userSlug);

    /**
     * Fetching members of a group.
     *
     * @param $groupSlug
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fetchMembers($groupSlug);
}
