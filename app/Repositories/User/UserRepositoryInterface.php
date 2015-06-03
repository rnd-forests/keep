<?php namespace Keep\Repositories\User;

interface UserRepositoryInterface {

    /**
     * Retrieve the collection of all users.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * Get the number of active users.
     *
     * @return int
     */
    public function count();

    /**
     * Retrieve a paginated collection of users.
     *
     * @param       $limit
     *
     * @param array $params
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPaginatedUsers($limit, array $params);

    /**
     * Find a user by ID.
     *
     * @param $id
     *
     * @return mixed
     */
    public function findById($id);

    /**
     * Find a user by slug.
     *
     * @param $slug
     *
     * @return mixed
     */
    public function findBySlug($slug);

    /**
     * Find a user by slug with eager loading tasks.
     *
     * @param $slug
     *
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public function findBySlugWithTasks($slug);

    /**
     * Find a user by activation code and active status.
     *
     * @param $code
     * @param $state
     *
     * @return mixed
     */
    public function findByCodeAndActiveState($code, $state);

    /**
     * Create a new user.
     *
     * @param array $credentials
     *
     * @return static
     */
    public function create(array $credentials);

    /**
     * Update user credentials.
     *
     * @param       $slug
     * @param array $credentials
     *
     * @return mixed
     */
    public function updateProfile($slug, array $credentials);

    /**
     * Restore a disabled user.
     *
     * @param $slug
     *
     * @return bool
     */
    public function restore($slug);

    /**
     * Soft delete a user.
     *
     * @param $slug
     *
     * @return mixed
     */
    public function delete($slug);

    /**
     * Permanently delete a user.
     *
     * @param $slug
     *
     * @return void
     */
    public function forceDelete($slug);

    /**
     * Get the trashed users.
     *
     * @param $limit
     *
     * @return mixed
     */
    public function getTrashedUsers($limit);

    /**
     * Find a trashed user by slug.
     *
     * @param $slug
     *
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public function findTrashedUserBySlug($slug);

    /**
     * Get paginated tasks associated with a given user.
     *
     * @param $user
     * @param $limit
     *
     * @return mixed
     */
    public function getPaginatedAssociatedTasks($user, $limit);

    /**
     * Fetch the collection of users by IDs.
     *
     * @param array $ids
     *
     * @return mixed
     */
    public function fetchUsersByIds(array $ids);

    /**
     * @param array $userData
     * @param       $provider
     *
     * @return mixed
     */
    public function findByUsernameOrCreate(array $userData, $provider);

}
