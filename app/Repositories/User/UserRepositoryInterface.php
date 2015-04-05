<?php namespace Keep\Repositories\User;

use Keep\User;

interface UserRepositoryInterface {

    public function all();
    public function getPaginatedUsers($num);
    public function getAuthUser();
    public function findById($id);
    public function findBySlug($slug);
    public function findByCodeAndActiveState($code, $state);
    public function create(array $credentials);
    public function update($slug, array $credentials);
    public function restore($slug);
    public function delete($slug);
    public function forceDelete($slug);
    public function getTasks(User $user);
    public function getTasksNotPaginated(User $user);
    public function getTrashedUsers();

}