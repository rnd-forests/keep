<?php namespace Keep\Repositories\User;

use Keep\Entities\User;

interface UserRepositoryInterface {

    public function getPaginatedUsers($limit, array $params);
    
    public function findBySlugWithTasks($slug);

    public function findByCodeAndActiveState($code, $state);

    public function create(array $credentials);

    public function updateProfile($slug, array $credentials);

    public function restore($slug);

    public function softDelete($slug);

    public function forceDelete($slug);

    public function getTrashedUsers($limit);

    public function findTrashedUserBySlug($slug);

    public function getPaginatedAssociatedTasks(User $user, $limit);

    public function fetchUsersByIds(array $ids);

    public function findOrCreateNew(array $userData, $provider);

}
