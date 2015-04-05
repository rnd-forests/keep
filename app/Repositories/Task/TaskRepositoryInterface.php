<?php namespace Keep\Repositories\Task;

interface TaskRepositoryInterface {

    public function all();
    public function getPaginatedTasks($num);
    public function findById($id);
    public function findCorrectTaskById($userId, $taskId);
    public function findCorrectTaskBySlug($userSlug, $taskSlug);
    public function create(array $data);
    public function update($userSlug, $taskSlug, array $data);
    public function delete($userSlug, $taskSlug);

}