<?php namespace Keep\Repositories\Task;

interface TaskRepositoryInterface {

    /**
     * Retrieve the collection of all tasks.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * Get the number of current active tasks.
     *
     * @return int
     */
    public function count();

    /**
     * Retrieve the paginated collection of tasks.
     *
     * @param $limit
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPaginatedTasks($limit);

    /**
     * Find a task by ID.
     *
     * @param $id
     *
     * @return mixed
     */
    public function findById($id);

    /**
     * Find a task by slug.
     *
     * @param $slug
     *
     * @return mixed
     */
    public function findBySlug($slug);

    /**
     * Find the correct task associated with a given user by its ID.
     *
     * @param $userId
     * @param $taskId
     *
     * @return mixed
     */
    public function findCorrectTaskById($userId, $taskId);

    /**
     * Find the correct task associated with a given user by its slug.
     *
     * @param $userSlug
     * @param $taskSlug
     *
     * @return mixed
     */
    public function findCorrectTaskBySlug($userSlug, $taskSlug);

    /**
     * Create a new task.
     *
     * @param array $data
     *
     * @return static
     */
    public function create(array $data);

    /**
     * Update a task.
     *
     * @param       $userSlug
     * @param       $taskSlug
     * @param array $data
     *
     * @return mixed
     */
    public function update($userSlug, $taskSlug, array $data);

    /**
     * Update a task (admin only).
     *
     * @param       $task
     * @param array $data
     *
     * @return mixed
     */
    public function adminUpdate($task, array $data);

    /**
     * Soft delete a task with user constraint.
     *
     * @param $userSlug
     * @param $taskSlug
     *
     * @return mixed
     */
    public function deleteWithUserConstraint($userSlug, $taskSlug);

    /**
     * Soft delete a task.
     *
     * @param $slug
     *
     * @return mixed
     */
    public function delete($slug);

    /**
     * Restore a soft deleted task.
     *
     * @param $slug
     *
     * @return bool
     */
    public function restore($slug);

    /**
     * Force delete a task.
     *
     * @param $slug
     *
     * @return mixed
     */
    public function forceDelete($slug);

    /**
     * Get the trashed tasks.
     *
     * @param $limit
     *
     * @return mixed
     */
    public function getTrashedTasks($limit);

    /**
     * Find a trashed task by slug.
     *
     * @param $slug
     *
     * @return mixed
     */
    public function findTrashedTaskBySlug($slug);

    /**
     * Mark a task as completed.
     *
     * @param $userSlug
     * @param $taskSlug
     *
     * @return mixed
     */
    public function complete($userSlug, $taskSlug);

    /**
     * Sync up the list of tags for the current task.
     *
     * @param       $task
     * @param array $tags
     *
     * @return mixed
     */
    public function syncTags($task, array $tags);

    /**
     * Associate a task with a specific priority level.
     *
     * @param $task
     * @param $priorityId
     *
     * @return mixed
     */
    public function associatePriority($task, $priorityId);

    /**
     * Fetch ten most urgent tasks of a user.
     *
     * @param $user
     *
     * @return mixed
     */
    public function fetchUserUrgentTasks($user);

    /**
     * Fetch ten tasks are up to deadline of a user.
     *
     * @param $user
     *
     * @return mixed
     */
    public function fetchUserDeadlineTasks($user);

    /**
     * Fetch recently completed tasks of a user.
     *
     * @param $user
     *
     * @return mixed
     */
    public function fetchRecentlyCompletedTasks($user);

}