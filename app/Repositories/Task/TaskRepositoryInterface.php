<?php namespace Keep\Repositories\Task;

interface TaskRepositoryInterface {

    /**
     * Retrieve the collection of all tasks.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all();

    /**
     * Get the number of current tasks.
     *
     * @return int
     */
    public function count();

    /**
     * Retrieve the paginated collection of tasks.
     *
     * @param $limit
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPaginatedTasks($limit);

    /**
     * Find a task by ID.
     *
     * @param $id
     * @return mixed
     */
    public function findById($id);

    /**
     * Find a task by slug.
     *
     * @param $slug
     * @return mixed
     */
    public function findBySlug($slug);

    /**
     * Find the correct task associated with a given user by its ID.
     *
     * @param $userId
     * @param $taskId
     * @return mixed
     */
    public function findCorrectTaskById($userId, $taskId);

    /**
     * Find the correct task associated with a given user by its slug.
     *
     * @param $userSlug
     * @param $taskSlug
     * @return mixed
     */
    public function findCorrectTaskBySlug($userSlug, $taskSlug);

    /**
     * Create a new task.
     *
     * @param array $data
     * @return static
     */
    public function create(array $data);

    /**
     * Update a task.
     *
     * @param       $userSlug
     * @param       $taskSlug
     * @param array $data
     * @return mixed
     */
    public function update($userSlug, $taskSlug, array $data);

    /**
     * Soft delete a task with user constraint.
     *
     * @param $userSlug
     * @param $taskSlug
     * @return mixed
     */
    public function deleteWithUserConstraint($userSlug, $taskSlug);

    /**
     * Soft delete a task.
     *
     * @param $slug
     * @return mixed
     */
    public function delete($slug);

    /**
     * Restore a soft delete task.
     *
     * @param $slug
     * @return bool
     */
    public function restore($slug);

    /**
     * Force delete a task.
     *
     * @param $slug
     * @return mixed
     */
    public function forceDelete($slug);

    /**
     * Get the trashed tasks.
     *
     * @return mixed
     */
    public function getTrashedTasks();

    /**
     * Find a trashed task by slug.
     *
     * @param $slug
     * @return mixed
     */
    public function findTrashedTaskBySlug($slug);

    /**
     * Sync up the list of tags for the current task.
     *
     * @param       $task
     * @param array $tags
     * @return mixed
     */
    public function syncTags($task, array $tags);

    /**
     * Associate a task with a specific priority level.
     *
     * @param $task
     * @param $priorityId
     * @return mixed
     */
    public function associatePriority($task, $priorityId);

}