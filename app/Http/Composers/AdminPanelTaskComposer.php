<?php  namespace Keep\Http\Composers; 

use Illuminate\Contracts\View\View;
use Keep\Repositories\Task\TaskRepositoryInterface;

class AdminPanelTaskComposer {

    protected $taskRepository;

    /**
     * Constructor.
     *
     * @param TaskRepositoryInterface $taskRepository
     */
    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * Compose admin panel task views.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('tasks', $this->taskRepository->getPaginatedTasks(40));
        $view->with('taskCount', $this->taskRepository->all()->count());
    }

}