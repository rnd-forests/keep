<?php namespace Keep\Repositories\Task;

use Keep\Entities\User;

interface TaskRepositoryInterface {

    public function getPaginatedTasks($limit, array $params);

    public function findBySlug($slug);

    public function findCorrectTaskBySlug($userSlug, $taskSlug);

    public function create(array $data);

    public function update($userSlug, $taskSlug, array $data);

    public function adminUpdate($task, array $data);

    public function deleteWithUserConstraint($userSlug, $taskSlug);

    public function softDelete($slug);

    public function restore($slug);

    public function forceDelete($slug);

    public function getTrashedTasks($limit);

    public function findTrashedTaskBySlug($slug);

    public function complete($userSlug, $taskSlug);

    public function syncTags($task, array $tags);

    public function associatePriority($task, $priorityId);

    public function fetchUserUrgentTasks(User $user);

    public function fetchUserDeadlineTasks(User $user);

    public function fetchUserRecentlyCompletedTasks(User $user);

    public function findAndUpdateFailedTasks();

    public function recoverFailedTasks();

    public function fetchUserRecentlyFailedTasks(User $user);

    public function fetchUserNewestTasks(User $user);

    public function fetchUserPaginatedTasksCollection(User $user);

    public function fetchUserPaginatedCompletedTasks(User $user);

    public function fetchUserPaginatedFailedTasks(User $user);

    public function fetchUserPaginatedDueTasks(User $user);

    public function fetchUserUpcomingTasks();

    public function fetchAllTasksOfAUser($userSlug);

    public function searchByTitle(User $user, $pattern);

}