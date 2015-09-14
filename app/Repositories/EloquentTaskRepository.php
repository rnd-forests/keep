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

    public function create(array $data)
    {
        return $this->model->create([
            'title'          => $data['title'],
            'content'        => $data['content'],
            'location'       => $data['location'],
            'starting_date'  => $data['starting_date'],
            'finishing_date' => $data['finishing_date'],
        ]);
    }

    public function update(array $data, $userSlug, $taskSlug = null)
    {
        $task = $this->find($userSlug, $taskSlug);
        $task->update($data);

        return $task;
    }

    public function adminUpdate(array $data, $task)
    {
        $task->update($data);

        return $task;
    }

    public function find($userSlug, $taskSlug)
    {
        $user = User::findBySlug($userSlug);

        return $this->model
            ->where('user_id', $user->id)
            ->where('slug', $taskSlug)
            ->firstOrFail();
    }

    public function delete($userSlug, $taskSlug)
    {
        return $this->find($userSlug, $taskSlug)->delete();
    }

    public function softDelete($slug)
    {
        return $this->findBySlug($slug)->delete();
    }

    public function findBySlug($slug)
    {
        return $this->model
            ->with('tags')
            ->where('slug', $slug)
            ->firstOrFail();
    }

    public function restore($slug)
    {
        $task = $this->findTrashedTask($slug);

        return $task->restore();
    }

    public function findTrashedTask($slug)
    {
        return $this->model
            ->onlyTrashed()
            ->where('slug', $slug)
            ->firstOrFail();
    }

    public function forceDelete($slug)
    {
        $task = $this->findTrashedTask($slug);
        $task->forceDelete();
    }

    public function trashed($limit)
    {
        return $this->model->with(['user' => function ($query) {
            $query->withTrashed();
        }, 'priority'])
            ->onlyTrashed()
            ->latest('deleted_at')
            ->paginate($limit);
    }

    public function complete($request, $userSlug, $taskSlug)
    {
        $task = $this->find($userSlug, $taskSlug);
        if ($request->ajax()) {
            if ($request->has('completed')) {
                $task->update([
                    'completed'   => 1,
                    'finished_at' => Carbon::now()
                ]);
            } else {
                $task->update([
                    'completed'   => 0,
                    'finished_at' => null
                ]);
            }
        }

        return $task;
    }

    public function syncTags($task, array $tags)
    {
        $task->tags()->sync($tags);
    }

    public function associatePriority($task, $priorityId)
    {
        $task->priority()->associate(Priority::findOrFail($priorityId));

        return $task->save();
    }

    public function urgentTasks($user)
    {
        return $user->tasks()
            ->urgent()
            ->take(5)
            ->get();
    }

    public function deadlineTasks($user)
    {
        return $user->tasks()
            ->deadline()
            ->take(5)
            ->get();
    }

    public function recentlyCompletedTasks($user)
    {
        return $user->tasks()
            ->recentlyCompleted()
            ->take(5)
            ->get();
    }

    public function findAndUpdateFailedTasks()
    {
        return $this->model
            ->aboutToFail()
            ->update(['is_failed' => true]);
    }

    public function recoverFailedTasks()
    {
        return $this->model
            ->where('is_failed', 1)
            ->where('finishing_date', '>=', Carbon::now())
            ->update(['is_failed' => false]);
    }

    public function allTasks($user)
    {
        return $user->tasks()
            ->latest('created_at')
            ->paginate(30);
    }

    public function completedTasks($user)
    {
        return $user->tasks()
            ->completed()
            ->latest('created_at')
            ->paginate(30);
    }

    public function failedTasks($user)
    {
        return $user->tasks()
            ->where('is_failed', 1)
            ->latest('created_at')
            ->paginate(30);
    }

    public function processingTasks($user)
    {
        return $user->tasks()
            ->due()
            ->latest('created_at')
            ->paginate(30);
    }

    public function upcomingTasks()
    {
        return $this->model
            ->upcoming()
            ->get();
    }
}
