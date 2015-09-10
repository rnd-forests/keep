<?php

namespace Keep\Repositories\Task;

interface TaskRepositoryInterface
{
    public function countAll();
    public function findBySlug($slug);
    public function fetchPaginatedTasks(array $params, $limit);
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
    public function complete($request, $userSlug, $taskSlug);
    public function syncTags($task, array $tags);
    public function associatePriority($task, $priorityId);
    public function fetchUrgentTasks($user);
    public function fetchDeadlineTasks($user);
    public function fetchRecentlyCompletedTasks($user);
    public function findAndUpdateFailedTasks();
    public function recoverFailedTasks();
    public function fetchPaginatedAllTasks($user);
    public function fetchPaginatedCompletedTasks($user);
    public function fetchPaginatedFailedTasks($user);
    public function fetchPaginatedDueTasks($user);
    public function fetchUpcomingTasks();
}
