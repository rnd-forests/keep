<?php
namespace Keep\Repositories\Task;

use Request;
use Carbon\Carbon;
use Keep\Entities\Task;
use Keep\Entities\User;
use Keep\Entities\Priority;
use Keep\Repositories\DbRepository;

class EloquentTaskRepository extends DbRepository implements TaskRepositoryInterface
{
    protected $model;

    public function __construct(Task $model)
    {
        $this->model = $model;
    }

    public function getPaginatedTasks($limit, array $params)
    {
        if ($this->isSortable($params)) {
            return $this->model->with('owner', 'priority')
                ->orderBy($params['sortBy'], $params['direction'])
                ->paginate($limit);
        }

        return $this->model
            ->with('owner', 'priority')
            ->paginate($limit);
    }

    public function create(array $data)
    {
        return $this->model->create([
            'title'          => $data['title'],
            'content'        => $data['content'],
            'location'       => $data['location'],
            'starting_date'  => $data['starting_date'],
            'finishing_date' => $data['finishing_date']
        ]);
    }

    public function update($userSlug, $taskSlug, array $data)
    {
        $task = $this->findCorrectTaskBySlug($userSlug, $taskSlug);
        $task->update($data);

        return $task;
    }

    public function adminUpdate($task, array $data)
    {
        $task->update($data);

        return $task;
    }

    public function findCorrectTaskBySlug($userSlug, $taskSlug)
    {
        $user = User::findBySlug($userSlug);

        return $this->model
            ->where('user_id', $user->id)
            ->where('slug', $taskSlug)
            ->firstOrFail();
    }

    public function deleteWithUserConstraint($userSlug, $taskSlug)
    {
        return $this->findCorrectTaskBySlug($userSlug, $taskSlug)->delete();
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
        $task = $this->findTrashedTaskBySlug($slug);

        return $task->restore();
    }

    public function findTrashedTaskBySlug($slug)
    {
        return $this->model
            ->onlyTrashed()
            ->where('slug', $slug)
            ->firstOrFail();
    }

    public function forceDelete($slug)
    {
        $task = $this->findTrashedTaskBySlug($slug);
        $task->forceDelete();
    }

    public function getTrashedTasks($limit)
    {
        return $this->model->with(['owner' => function ($query) {
            $query->withTrashed();
        }, 'destroyer', 'priority'])
            ->onlyTrashed()
            ->latest('deleted_at')
            ->paginate($limit);
    }

    public function complete($userSlug, $taskSlug)
    {
        $task = $this->findCorrectTaskBySlug($userSlug, $taskSlug);
        $task->completed = Request::input('completed') ? Request::input('completed') : 0;
        $task->finished_at = Carbon::now();

        return $task->save();
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

    public function fetchUserUrgentTasks(User $user)
    {
        return $user->tasks()
            ->urgent()
            ->take(10)
            ->get();
    }

    public function fetchUserDeadlineTasks(User $user)
    {
        return $user->tasks()
            ->toDeadline()
            ->take(10)
            ->get();
    }

    public function fetchUserRecentlyCompletedTasks(User $user)
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
        return $this->model->where('is_failed', 1)
            ->where('finishing_date', '>=', Carbon::now())
            ->update(['is_failed' => false]);
    }

    public function fetchUserRecentlyFailedTasks(User $user)
    {
        return $user->tasks()
            ->recentlyFailed()
            ->take(5)
            ->get();
    }

    public function fetchUserNewestTasks(User $user)
    {
        return $user->tasks()
            ->newest()
            ->take(5)
            ->get();
    }

    public function fetchUserPaginatedTasksCollection(User $user)
    {
        return $user->tasks()
            ->latest('created_at')
            ->paginate(30);
    }

    public function fetchUserPaginatedCompletedTasks(User $user)
    {
        return $user->tasks()
            ->completed()
            ->latest('created_at')
            ->paginate(30);
    }

    public function fetchUserPaginatedFailedTasks(User $user)
    {
        return $user->tasks()
            ->where('is_failed', 1)
            ->latest('created_at')
            ->paginate(30);
    }

    public function fetchUserPaginatedDueTasks(User $user)
    {
        return $user->tasks()
            ->due()
            ->latest('created_at')
            ->paginate(30);
    }

    public function fetchUserUpcomingTasks()
    {
        return $this->model
            ->userCreated()
            ->upcoming()
            ->get();
    }

    public function fetchAllTasksOfAUser($userSlug)
    {
        $user = User::findBySlug($userSlug);

        return $this->model->where(['user_id' => $user->id, 'completed' => 0])->get([
            'title', 'starting_date', 'finishing_date', 'priority_id'
        ])->map(function ($task) {
            return [
                'content'   => $task->title,
                'endDate'   => Carbon::parse($task->finishing_date)->toDayDateTimeString(),
                'startDate' => Carbon::parse($task->starting_date)->toDayDateTimeString(),
                'color'     => $task->priority_id
            ];
        })->toArray();
    }

    public function searchByTitle(User $user, $pattern)
    {
        return $user->tasks()
            ->search($pattern)
            ->latest('created_at')
            ->paginate(15);
    }
}