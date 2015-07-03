<?php

namespace Keep\Repositories\Task;

interface TaskRepositoryInterface
{
    public function fetchPaginatedTasks(array $params, $limit);
    public function findBySlug($slug);
    public function findCorrectTaskBySlug($userSlug, $taskSlug);
    public function create(array $data);
    public function update(array $data, $userSlug, $taskSlug);
    public function adminUpdate(array $data, $task);
    public function deleteWithUserConstraint($userSlug, $taskSlug);
    public function softDelete($slug);
    public function restore($slug);
    public function forceDelete($slug);
    public function fetchTrashedTasks($limit);
    public function findTrashedTaskBySlug($slug);
    public function complete($userSlug, $taskSlug);
    public function syncTags($task, array $tags);
    public function associatePriority($task, $priorityId);
    public function fetchUserUrgentTasks($user);
    public function fetchUserDeadlineTasks($user);
    public function fetchUserRecentlyCompletedTasks($user);
    public function findAndUpdateFailedTasks();
    public function recoverFailedTasks();
    public function fetchUserRecentlyFailedTasks($user);
    public function fetchUserNewestTasks($user);
    public function fetchUserPaginatedTasksCollection($user);
    public function fetchUserPaginatedCompletedTasks($user);
    public function fetchUserPaginatedFailedTasks($user);
    public function fetchUserPaginatedDueTasks($user);
    public function fetchUserUpcomingTasks();
    public function fetchAllTasksOfAUser($userSlug);
    public function searchByTitle($user, $pattern);
}
