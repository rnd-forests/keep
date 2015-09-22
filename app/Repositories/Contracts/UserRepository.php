<?php

namespace Keep\Repositories\Contracts;

interface UserRepository
{
    /**
     * Fetching a paginated collection of disabled users.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function disabled();

    /**
     * Fetching a collection of users using an array of ids.
     *
     * @param array $ids
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fetchByIds(array $ids);

    /**
     * Finding a disabled user.
     *
     * @param $slug
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findDisabledUser($slug);

    /**
     * Fetching a user and user's associated tasks.
     *
     * @param $slug
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findBySlugWithTasks($slug);

    /**
     * Finding a user or creating a new user if the user does not exist.
     *
     * @param array $userData
     * @param $authProvider
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findOrCreate(array $userData, $authProvider);

    /**
     * Find a user by activation code.
     *
     * @param $code
     * @param bool|false $active
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findByActivationCode($code, $active = false);
}
