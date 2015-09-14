<?php

namespace Keep\Repositories\Contracts;

interface UserRepositoryInterface
{
    public function disabled();
    public function fetchByIds(array $ids);
    public function findDisabledUser($slug);
    public function findBySlugWithTasks($slug);
    public function findOrCreate(array $userData, $authProvider);
    public function findByActivationCode($code, $active = false);
}
