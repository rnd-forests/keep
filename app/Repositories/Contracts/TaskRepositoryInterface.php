<?php

namespace Keep\Repositories\Contracts;

interface TaskRepositoryInterface
{
    public function find($userSlug, $taskSlug);
    public function adminUpdate(array $data, $task);
    public function delete($userSlug, $taskSlug);
    public function trashed($limit);
    public function findTrashedTask($slug);
    public function complete($request, $userSlug, $taskSlug);
    public function syncTags($task, array $tags);
    public function associatePriority($task, $priorityId);
    public function urgentTasks($user);
    public function deadlineTasks($user);
    public function recentlyCompletedTasks($user);
    public function findAndUpdateFailedTasks();
    public function recoverFailedTasks();
    public function allTasks($user);
    public function completedTasks($user);
    public function failedTasks($user);
    public function processingTasks($user);
    public function upcomingTasks();
}
