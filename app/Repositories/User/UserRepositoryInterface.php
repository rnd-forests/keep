<?php

namespace Keep\Repositories\User;

interface UserRepositoryInterface
{
    public function getAll();
    public function countAll();
    public function findBySlug($slug);
    public function fetchPaginatedUsers(array $params, $limit);
    public function findBySlugEagerLoadTasks($slug);
    public function findByActivationCode($code, $active = false);
    public function create(array $credentials);
    public function updateProfile(array $credentials, $slug);
    public function restore($slug);
    public function softDelete($slug);
    public function forceDelete($slug);
    public function fetchDisabledUsers($limit);
    public function findDisabledUserBySlug($slug);
    public function fetchUsersByIds(array $ids);
    public function findOrCreateNew(array $userData, $authProvider);
}
