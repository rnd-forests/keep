<?php

namespace Keep\Repositories\Contracts;

interface TaskRepository
{
    /**
     * Finding a task.
     *
     * @param $userSlug
     * @param $taskSlug
     * @return mixed
     */
    public function find($userSlug, $taskSlug);

    /**
     * Updating a task (for administrator).
     *
     * @param array $data
     * @param $task
     * @return mixed
     */
    public function adminUpdate(array $data, $task);

    /**
     * Deleting a task.
     *
     * @param $userSlug
     * @param $taskSlug
     * @return mixed
     */
    public function delete($userSlug, $taskSlug);

    /**
     * Fetching trashed tasks.
     *
     * @param $limit
     * @return mixed
     */
    public function trashed($limit);

    /**
     * Finding a trashed task.
     *
     * @param $slug
     * @return mixed
     */
    public function findTrashedTask($slug);

    /**
     * Completing a task.
     *
     * @param $request
     * @param $userSlug
     * @param $taskSlug
     * @return mixed
     */
    public function complete($request, $userSlug, $taskSlug);

    /**
     * Syncing up tags of a task.
     *
     * @param $task
     * @param array $tags
     * @return mixed
     */
    public function syncTags($task, array $tags);

    /**
     * Associating a priority level with a task.
     *
     * @param $task
     * @param $priorityId
     * @return mixed
     */
    public function associatePriority($task, $priorityId);

    /**
     * Fetching urgent tasks.
     *
     * @param $user
     * @return mixed
     */
    public function urgentTasks($user);

    /**
     * Fetching deadline tasks.
     *
     * @param $user
     * @return mixed
     */
    public function deadlineTasks($user);

    /**
     * Fetching recently completed tasks.
     *
     * @param $user
     * @return mixed
     */
    public function recentlyCompletedTasks($user);

    /**
     * Finding and marking tasks as failed.
     *
     * @return mixed
     */
    public function findAndUpdateFailedTasks();

    /**
     * Finding and recovering failed tasks.
     *
     * @return mixed
     */
    public function recoverFailedTasks();

    /**
     * Fetching all tasks of a user.
     *
     * @param $user
     * @return mixed
     */
    public function allTasks($user);

    /**
     * Fetching completed tasks of a user.
     *
     * @param $user
     * @return mixed
     */
    public function completedTasks($user);

    /**
     * Fetching failed tasks of a user.
     *
     * @param $user
     * @return mixed
     */
    public function failedTasks($user);

    /**
     * Fetching processing tasks of a user.
     *
     * @param $user
     * @return mixed
     */
    public function processingTasks($user);

    /**
     * Fetching upcoming tasks of all users.
     *
     * @return mixed
     */
    public function upcomingTasks();
}
