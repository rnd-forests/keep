<?php

namespace Keep\Repositories\Contracts;

interface TaskRepository
{
    /**
     * Finding a task.
     *
     * @param $userSlug
     * @param $taskSlug
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function find($userSlug, $taskSlug);

    /**
     * Updating a task (for administrator).
     *
     * @param array $data
     * @param $task
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function adminUpdate(array $data, $task);

    /**
     * Deleting a task.
     *
     * @param $userSlug
     * @param $taskSlug
     * @return bool|null
     */
    public function delete($userSlug, $taskSlug);

    /**
     * Fetching trashed tasks.
     *
     * @param $limit
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function trashed($limit);

    /**
     * Finding a trashed task.
     *
     * @param $slug
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findTrashedTask($slug);

    /**
     * Completing a task.
     *
     * @param $request
     * @param $userSlug
     * @param $taskSlug
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function complete($request, $userSlug, $taskSlug);

    /**
     * Syncing up tags of a task.
     *
     * @param $task
     * @param array $tags
     * @return array
     */
    public function syncTags($task, array $tags);

    /**
     * Associating a priority level with a task.
     *
     * @param $task
     * @param $priorityId
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function associatePriority($task, $priorityId);

    /**
     * Fetching urgent tasks.
     *
     * @param $user
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function urgentTasks($user);

    /**
     * Fetching deadline tasks.
     *
     * @param $user
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function deadlineTasks($user);

    /**
     * Fetching recently completed tasks.
     *
     * @param $user
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function recentlyCompletedTasks($user);

    /**
     * Finding and marking tasks as failed.
     * Finding and recovering failed tasks.
     *
     * @param $request
     * @param $user
     * @return bool|int
     */
    public function syncFailedTasks($request, $user);

    /**
     * Fetching all tasks of a user.
     *
     * @param $user
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function allTasks($user);

    /**
     * Fetching completed tasks of a user.
     *
     * @param $user
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function completedTasks($user);

    /**
     * Fetching failed tasks of a user.
     *
     * @param $user
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function failedTasks($user);

    /**
     * Fetching processing tasks of a user.
     *
     * @param $user
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function processingTasks($user);

    /**
     * Fetching upcoming tasks of all users.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function upcomingTasks();

    /**
     * Fetching upcoming tasks of all users with only
     * some attributes.
     *
     * @return array
     */
    public function upcomingTasksForConsole();
}
