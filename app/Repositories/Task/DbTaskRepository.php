<?php namespace Keep\Repositories\Task;

use Request;
use Carbon\Carbon;
use Keep\Entities\Task;
use Keep\Entities\User;
use Keep\Entities\Priority;

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
        return $user->tasks()->urgent()->take(10)->get();
    }

    public function fetchUserDeadlineTasks($user)
    {
        return $user->tasks()->toDeadline()->take(10)->get();
    }

    public function fetchUserRecentlyCompletedTasks($user)
    {
        return $user->tasks()->recentlyCompleted()->take(5)->get();
    }

    public function findAndUpdateFailedTasks()
    {
        return Task::aboutToFail()->update(['is_failed' => true]);
    }

    public function recoverFailedTasks()
    {
        return Task::where('is_failed', 1)
            ->where('finishing_date', '>=', Carbon::now())
            ->update(['is_failed' => false]);
    }

    public function fetchUserRecentlyFailedTasks($user)
    {
        return $user->tasks()->recentlyFailed()->take(5)->get();
    }

    public function fetchUserNewestTasks($user)
    {
        return $user->tasks()->newest()->take(5)->get();
    }

    public function fetchUserPaginatedTasksCollection($user)
    {
        return $user->tasks()->orderBy('created_at', 'desc')->paginate(30);
    }

    public function fetchUserPaginatedCompletedTasks($user)
    {
        return $user->tasks()->completed()->orderBy('created_at', 'desc')->paginate(30);
    }

    public function fetchUserPaginatedFailedTasks($user)
    {
        return $user->tasks()->where('is_failed', 1)->orderBy('created_at', 'desc')->paginate(30);
    }

    public function fetchUserPaginatedDueTasks($user)
    {
        return $user->tasks()->due()->orderBy('created_at', 'desc')->paginate(30);
    }

    public function fetchUserUpcomingTasks()
    {
        return Task::userCreated()->upcoming()->get();
    }

    public function fetchAllTasksOfAUser($userSlug)
    {
        $user = User::findBySlug($userSlug);

        return Task::where(['user_id' => $user->id, 'completed' => 0])->get(['title', 'starting_date', 'finishing_date'])->map(function ($task)
        {
            return array(
                'content' => $task->title,
                'endDate' => Carbon::parse($task->finishing_date)->toDayDateTimeString(),
                'startDate' => Carbon::parse($task->starting_date)->toDayDateTimeString()
            );
        })->toArray();
    }

}