<?php namespace Keep\Repositories\UserGroup;

interface UserGroupRepositoryInterface {

    /**
     * Retrieve the collection of all user groups.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * Get the current number of user groups.
     *
     * @return int
     */
    public function count();

    /**
     * Get the paginated collection of user groups.
     *
     * @param $limit
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPaginatedGroups($limit);

    /**
     * Find a group by its ID.
     *
     * @param $id
     *
     * @return mixed
     */
    public function findById($id);

    /**
     * Find a group by its slug.
     *
     * @param $slug
     *
     * @return mixed
     */
    public function findBySlug($slug);

    /**
     * Create a new group.
     *
     * @param array $data
     *
     * @return static
     */
    public function create(array $data);

    /**
     * Update a group information.
     *
     * @param       $slug
     * @param array $data
     *
     * @return mixed
     */
    public function update($slug, array $data);

    /**
     * Restore a soft deleted group.
     *
     * @param $slug
     *
     * @return bool
     */
    public function restore($slug);

    /**
     * Soft delete a group.
     *
     * @param $slug
     *
     * @return mixed
     */
    public function delete($slug);

    /**
     * Permanently delete a group.
     *
     * @param $slug
     *
     * @return void
     */
    public function forceDelete($slug);

    /**
     * Get trashed groups.
     *
     * @param $limit
     *
     * @return mixed
     */
    public function getTrashedGroups($limit);

    /**
     * Find a trashed group by its slug.
     *
     * @param $slug
     *
     * @return mixed
     */
    public function findTrashedGroupBySlug($slug);

    /**
     * Get paginated users associated with given group.
     *
     * @param $group
     * @param $limit
     *
     * @return mixed
     */
    public function getPaginatedAssociatedUsers($group, $limit);

    /**
     * Get all users that do not belong to a specific group.
     *
     * @param $slug
     *
     * @return mixed
     */
    public function getUsersOutsideGroup($slug);

    /**
     * Attach new users to a specific group.
     *
     * @param       $group
     * @param array $users
     *
     * @return mixed
     */
    public function attachUsers($group, array $users);

    /**
     * Fetch a collection of groups by their IDs.
     *
     * @param array $ids
     *
     * @return mixed
     */
    public function fetchGroupsByIds(array $ids);

}