<?php namespace Keep\Repositories\User;

use Keep\User;

interface UserRepositoryInterface {

    /**
     * Retrieve the collection of all users.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
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
     * @param $limit
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPaginatedUsers($limit);

    /**
     * Get the current authenticated user.
     *
     * @return User|null
     */
    public function getAuthUser();

    /**
     * Find a user by Id.
     *
     * @param $id
     * @return mixed
     */
    public function findById($id);

    /**
     * Find a user by slug.
     *
     * @param $slug
     * @return mixed
     */
    public function findBySlug($slug);

    /**
     * Find a user by slug with paginated eager loading tasks.
     *
     * @param $slug
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public function findBySlugWithTasks($slug);

    /**
     * Find a user by activation code and active status.
     *
     * @param $code
     * @param $state
     * @return mixed
     */
    public function findByCodeAndActiveState($code, $state);

    /**
     * Create a new user.
     *
     * @param array $credentials
     * @return static
     */
    public function create(array $credentials);

    /**
     * Update user credentials.
     *
     * @param       $slug
     * @param array $credentials
     * @return mixed
     */
    public function update($slug, array $credentials);

    /**
     * Restore a disabled user.
     *
     * @param $slug
     * @return bool
     */
    public function restore($slug);

    /**
     * Soft delete a user.
     *
     * @param $slug
     * @return mixed
     */
    public function delete($slug);

    /**
     * Permanently delete a user.
     *
     * @param $slug
     * @return void
     */
    public function forceDelete($slug);

    /**
     * Get the trashed users.
     *
     * @return mixed
     */
    public function getTrashedUsers();

    /**
     * Find a trashed user by slug.
     *
     * @param $slug
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public function findTrashedUserBySlug($slug);

    /**
     * Get paginated tasks associated with a given user.
     *
     * @param $user
     * @param $limit
     * @return mixed
     */
    public function getPaginatedAssociatedTasks($user, $limit);

}