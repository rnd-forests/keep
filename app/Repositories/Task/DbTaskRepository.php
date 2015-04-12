<?php  namespace Keep\Repositories\Task; 

use Keep\Task;
use Keep\User;

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
        return Task::with('owner')->paginate($limit);
    }

    public function findById($id)
    {
        return Task::findOrFail($id);
    }

    public function findBySlug($slug)
    {
        return Task::with('tags')->whereSlug($slug)->firstOrFail();
    }

    public function findCorrectTaskById($userId, $taskId)
    {
        return Task::whereUserIdAndId($userId, $taskId)->firstOrFail();
    }

    public function findCorrectTaskBySlug($userSlug, $taskSlug)
    {
        $user = User::findBySlug($userSlug);

        return Task::whereUserIdAndSlug($user->id, $taskSlug)->firstOrFail();
    }

    public function create(array $data)
    {
        return Task::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'note' => $data['note'],
            'location' => $data['location'],
            'starting_date' => $data['starting_date'],
            'finishing_date' => $data['finishing_date'],
            'completed' => false
        ]);
    }

    public function update($userSlug, $taskSlug, array $data)
    {
        $task = $this->findCorrectTaskBySlug($userSlug, $taskSlug);

        $task->update($data);

        return $task;
    }

    public function deleteWithUserConstraint($userSlug, $taskSlug)
    {
        return $this->findCorrectTaskBySlug($userSlug, $taskSlug)->delete();
    }

    public function delete($slug)
    {
        return $this->findBySlug($slug)->delete();
    }

    public function restore($slug)
    {
        $task = $this->findTrashedTaskBySlug($slug);

        return $task->restore();
    }

    public function forceDelete($slug)
    {
        $task = $this->findTrashedTaskBySlug($slug);

        $task->forceDelete();
    }

    public function getTrashedTasks()
    {
        return Task::with('owner', 'destroyer')->onlyTrashed()->latest('deleted_at')->paginate(50);
    }

    public function findTrashedTaskBySlug($slug)
    {
        return Task::onlyTrashed()->whereSlug($slug)->firstOrFail();
    }

    public function syncTags($task, array $tags)
    {
        $task->tags()->sync($tags);
    }

}