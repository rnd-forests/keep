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
     * @param $num
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPaginatedTasks($num);

    /**
     * Find a task by ID.
     *
     * @param $id
     * @return mixed
     */
    public function findById($id);

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
     * Soft delete a task.
     *
     * @param $userSlug
     * @param $taskSlug
     * @return mixed
     */
    public function delete($userSlug, $taskSlug);

}