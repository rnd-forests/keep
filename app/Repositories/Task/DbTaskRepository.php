<?php  namespace Keep\Repositories\Task; 

use Keep\Task;
use Keep\User;

class DbTaskRepository implements TaskRepositoryInterface {

    public function all()
    {
        return Task::all();
    }

    public function paginate($num)
    {
        return Task::paginate($num);
    }

    public function findById($id)
    {
        return Task::findOrFail($id);
    }

    public function findCorrectTaskById($userId, $taskId)
    {
        return Task::where(['user_id' => $userId, 'id' => $taskId])->firstOrFail();
    }

    public function findCorrectTaskBySlug($userSlug, $taskSlug)
    {
        $user = User::findBySlug($userSlug);

        return Task::where(['user_id' => $user->id, 'slug' => $taskSlug])->firstOrFail();
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

    public function delete($userSlug, $taskSlug)
    {
        return $this->findCorrectTaskBySlug($userSlug, $taskSlug)->delete();
    }

}