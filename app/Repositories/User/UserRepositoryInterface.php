<?php namespace Keep\Repositories\User;

use Keep\User;

interface UserRepositoryInterface {

    public function all();
    public function paginate($num);
    public function getAuthUser();
    public function findById($id);
    public function findBySlug($slug);
    public function findByCodeAndActiveState($code, $state);
    public function create(array $credentials);
    public function update($slug, array $credentials);
    public function delete($slug);
    public function getTasks(User $user);
    public function getTasksNotPaginated(User $user);

}