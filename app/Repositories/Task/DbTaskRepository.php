<?php namespace Keep\Repositories\Task;

use Request;
use Keep\Task;
use Keep\User;
use Carbon\Carbon;
use Keep\Priority;

class DbTaskRepository implements TaskRepositoryInterface {

    public function all()
    {
        return Task::all();
    }

    public function count()
    {
        return Task::count();
    }

    public function getPaginatedTasks($limit)
    {
        return Task::with('owner', 'priority')->orderBy('created_at', 'desc')->paginate($limit);
    }

    public function findById($id)
    {
        return Task::findOrFail($id);
    }

    public function findCorrectTaskById($userId, $taskId)
    {
        return Task::whereUserIdAndId($userId, $taskId)->firstOrFail();
    }

    public function create(array $data)
    {
        return Task::create([
            'title'          => $data['title'],
            'content'        => $data['content'],
            'location'       => $data['location'],
            'starting_date'  => $data['starting_date'],
            'finishing_date' => $data['finishing_date'],
            'completed'      => false,
            'is_assigned'    => false
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

        return Task::whereUserIdAndSlug($user->id, $taskSlug)->firstOrFail();
    }

    public function deleteWithUserConstraint($userSlug, $taskSlug)
    {
        return $this->findCorrectTaskBySlug($userSlug, $taskSlug)->delete();
    }

    public function delete($slug)
    {
        return $this->findBySlug($slug)->delete();
    }

    public function findBySlug($slug)
    {
        return Task::with('tags')->whereSlug($slug)->firstOrFail();
    }

    public function restore($slug)
    {
        $task = $this->findTrashedTaskBySlug($slug);

        return $task->restore();
    }

    public function findTrashedTaskBySlug($slug)
    {
        return Task::onlyTrashed()->whereSlug($slug)->firstOrFail();
    }

    public function forceDelete($slug)
    {
        $task = $this->findTrashedTaskBySlug($slug);

        $task->forceDelete();
    }

    public function getTrashedTasks($limit)
    {
        return Task::with(['owner' => function ($query)
        {
            $query->withTrashed();
        }, 'destroyer', 'priority'])->onlyTrashed()->latest('deleted_at')->paginate($limit);
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

    public function fetchUserUrgentTasks($user)
    {
        return $user->tasks()->urgent()->get();
    }

    public function fetchUserDeadlineTasks($user)
    {
        return $user->tasks()->toDeadline()->get();
    }

    public function fetchRecentlyCompletedTasks($user)
    {
        return $user->tasks()->recentlyCompleted()->get();
    }

    public function findAndUpdateFailedTasks()
    {
        return Task::aboutToFail()->update(['is_failed' => true]);
    }

    public function fetchRecentlyFailedTasks($user)
    {
        return $user->tasks()->recentlyFailed()->get();
    }

}