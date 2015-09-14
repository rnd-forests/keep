<?php

namespace Keep\Repositories\Contracts;

interface UserRepositoryInterface
{
    public function getAll();
    public function countAll();
    public function findBySlug($slug);
    public function fetchPaginatedUsers(array $params, $limit);
    public function findBySlugWithTasks($slug);
    public function findByActivationCode($code, $active = false);
    public function create(array $credentials);
    public function updateProfile(array $credentials, $slug);
    public function restore($slug);
    public function softDelete($slug);
    public function forceDelete($slug);
    public function disabledUsers();
    public function disabledUser($slug);
    public function fetchByIds(array $ids);
    public function findOrCreate(array $userData, $authProvider);
}
