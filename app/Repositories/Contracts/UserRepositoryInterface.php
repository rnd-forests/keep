<?php

namespace Keep\Repositories\Contracts;

interface UserRepositoryInterface
{
    /**
     * Fetching a paginated collection of disabled users.
     *
     * @return mixed
     */
    public function disabled();

    /**
     * Fetching a collection of users using an array of ids.
     *
     * @param array $ids
     *
     * @return mixed
     */
    public function fetchByIds(array $ids);

    /**
     * Finding a disabled user.
     *
     * @param $slug
     *
     * @return mixed
     */
    public function findDisabledUser($slug);

    /**
     * Fetching a user and user's associated tasks.
     *
     * @param $slug
     *
     * @return mixed
     */
    public function findBySlugWithTasks($slug);

    /**
     * Finding a user or creating a new user if the user does not exist.
     *
     * @param array $userData
     * @param $authProvider
     *
     * @return mixed
     */
    public function findOrCreate(array $userData, $authProvider);

    /**
     * Find a user by activation code.
     *
     * @param $code
     * @param bool|false $active
     *
     * @return mixed
     */
    public function findByActivationCode($code, $active = false);
}
