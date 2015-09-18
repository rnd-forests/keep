<?php

namespace Keep\Repositories;

use Carbon\Carbon;
use Keep\Entities\Task;
use Keep\Entities\User;
use Keep\Entities\Priority;
use Keep\Repositories\Contracts\Common\Findable;
use Keep\Repositories\Contracts\Common\Removable;
use Keep\Repositories\Contracts\Common\Updateable;
use Keep\Repositories\Contracts\Common\Paginateable;
use Keep\Repositories\Contracts\TaskRepositoryInterface;
use Keep\Repositories\Contracts\Common\RepositoryInterface;

class EloquentTaskRepository extends AbstractEloquentRepository implements
    Findable,
    Removable,
    Updateable,
    Paginateable,
    RepositoryInterface,
    TaskRepositoryInterface
{
    protected $model;

    public function __construct(Task $model)
    {
        $this->model = $model;
    }

    /**
     * Paginate a collection of models.
     *
     * @param $limit
     * @param array|null $params
     *
     * @return mixed
     */
    public function paginate($limit, array $params = null)
    {
        if ($this->isSortable($params)) {
            return $this->model
                ->with('user', 'priority')
                ->orderBy($params['sortBy'], $params['direction'])
                ->paginate($limit);
        }

        return $this->model
            ->with('user', 'priority')
            ->paginate($limit);
    }

    /**
     * Restore a soft deleted model instance.
     *
     * @param $identifier
     *
     * @return mixed
     */
    public function restore($identifier)
    {
        $task = $this->findTrashedTask($identifier);

        return $task->restore();
    }

    /**
     * Soft delete a model instance.
     *
     * @param $identifier
     *
     * @return mixed
     */
    public function softDelete($identifier)
    {
        return $this->findBySlug($identifier)->delete();
    }

    /**
     * Permanently delete a soft deleted model instance.
     *
     * @param $identifier
     *
     * @return mixed
     */
    public function forceDelete($identifier)
    {
        $task = $this->findTrashedTask($identifier);
        $task->forceDelete();
    }

    /**
     * Create a new model instance.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create([
            'title' => $data['title'],
            'content' => $data['content'],
            'location' => $data['location'],
            'starting_date' => $data['starting_date'],
            'finishing_date' => $data['finishing_date'],
        ]);
    }

    /**
     * Finding a task.
     *
     * @param $userSlug
     * @param $taskSlug
     *
     * @return mixed
     */
    public function find($userSlug, $taskSlug)
    {
        $user = User::findBySlug($userSlug);

        return $this->model
            ->where('user_id', $user->id)
            ->where('slug', $taskSlug)
            ->firstOrFail();
    }

    /**
     * Updating a task (for administrator).
     *
     * @param array $data
     * @param $task
     *
     * @return mixed
     */
    public function adminUpdate(array $data, $task)
    {
        $task->update($data);

        return $task;
    }

    /**
     * Deleting a task.
     *
     * @param $userSlug
     * @param $taskSlug
     *
     * @return mixed
     */
    public function delete($userSlug, $taskSlug)
    {
        return $this->find($userSlug, $taskSlug)->delete();
    }

    /**
     * Fetching trashed tasks.
     *
     * @param $limit
     *
     * @return mixed
     */
    public function trashed($limit)
    {
        return $this->model->with(['user' => function ($query) {
            $query->withTrashed();
        }, 'priority'])
            ->onlyTrashed()
            ->latest('deleted_at')
            ->paginate($limit);
    }

    /**
     * Finding a trashed task.
     *
     * @param $slug
     *
     * @return mixed
     */
    public function findTrashedTask($slug)
    {
        return $this->model
            ->onlyTrashed()
            ->where('slug', $slug)
            ->firstOrFail();
    }

    /**
     * Completing a task.
     *
     * @param $request
     * @param $userSlug
     * @param $taskSlug
     *
     * @return mixed
     */
    public function complete($request, $userSlug, $taskSlug)
    {
        $task = $this->find($userSlug, $taskSlug);
        if ($request->ajax()) {
            if ($request->has('completed')) {
                $task->update([
                    'completed' => 1,
                    'finished_at' => Carbon::now(),
                ]);
            } else {
                $task->update([
                    'completed' => 0,
                    'finished_at' => null,
                ]);
            }
        }

        return $task;
    }

    /**
     * Syncing up tags of a task.
     *
     * @param $task
     * @param array $tags
     *
     * @return mixed
     */
    public function syncTags($task, array $tags)
    {
        $task->tags()->sync($tags);
    }

    /**
     * Associating a priority level with a task.
     *
     * @param $task
     * @param $priorityId
     *
     * @return mixed
     */
    public function associatePriority($task, $priorityId)
    {
        $task->priority()->associate(Priority::findOrFail($priorityId));

        return $task->save();
    }

    /**
     * Fetching urgent tasks.
     *
     * @param $user
     *
     * @return mixed
     */
    public function urgentTasks($user)
    {
        return $user->tasks()
            ->urgent()
            ->take(5)
            ->get();
    }

    /**
     * Fetching deadline tasks.
     *
     * @param $user
     *
     * @return mixed
     */
    public function deadlineTasks($user)
    {
        return $user->tasks()
            ->deadline()
            ->take(5)
            ->get();
    }

    /**
     * Fetching recently completed tasks.
     *
     * @param $user
     *
     * @return mixed
     */
    public function recentlyCompletedTasks($user)
    {
        return $user->tasks()
            ->recentlyCompleted()
            ->take(5)
            ->get();
    }

    /**
     * Finding and marking tasks as failed.
     *
     * @return mixed
     */
    public function findAndUpdateFailedTasks()
    {
        return $this->model
            ->aboutToFail()
            ->update(['is_failed' => true]);
    }

    /**
     * Finding and recovering failed tasks.
     *
     * @return mixed
     */
    public function recoverFailedTasks()
    {
        return $this->model
            ->where('is_failed', 1)
            ->where('finishing_date', '>=', Carbon::now())
            ->update(['is_failed' => false]);
    }

    /**
     * Fetching all tasks of a user.
     *
     * @param $user
     *
     * @return mixed
     */
    public function allTasks($user)
    {
        return $user->tasks()
            ->latest('created_at')
            ->paginate(30);
    }

    /**
     * Fetching completed tasks of a user.
     *
     * @param $user
     *
     * @return mixed
     */
    public function completedTasks($user)
    {
        return $user->tasks()
            ->completed()
            ->latest('created_at')
            ->paginate(30);
    }

    /**
     * Fetching failed tasks of a user.
     *
     * @param $user
     *
     * @return mixed
     */
    public function failedTasks($user)
    {
        return $user->tasks()
            ->where('is_failed', 1)
            ->latest('created_at')
            ->paginate(30);
    }

    /**
     * Fetching processing tasks of a user.
     *
     * @param $user
     *
     * @return mixed
     */
    public function processingTasks($user)
    {
        return $user->tasks()
            ->due()
            ->latest('created_at')
            ->paginate(30);
    }

    /**
     * Fetching upcoming tasks of all users.
     *
     * @return mixed
     */
    public function upcomingTasks()
    {
        return $this->model
            ->upcoming()
            ->get();
    }

    /**
     * Update a model instance.
     *
     * @param array $data
     * @param $identifier
     * @param null $optionalIdentifier
     *
     * @return mixed
     */
    public function update(array $data, $identifier, $optionalIdentifier = null)
    {
        $task = $this->find($identifier, $optionalIdentifier);
        $task->update($data);

        return $task;
    }

    /**
     * Find a model instance by its slug.
     *
     * @param $slug
     *
     * @return mixed
     */
    public function findBySlug($slug)
    {
        return $this->model
            ->with('tags')
            ->where('slug', $slug)
            ->firstOrFail();
    }
}
