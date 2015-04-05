<?php  namespace Keep\Http\Composers; 

use Illuminate\Contracts\View\View;
use Keep\Repositories\Task\TaskRepositoryInterface;
use Keep\Repositories\User\UserRepositoryInterface;

class AdminPanelComposer {

    protected $userRepository, $taskRepository;

    /**
     * Constructor.
     *
     * @param UserRepositoryInterface $userRepository
     * @param TaskRepositoryInterface $taskRepository
     */
    public function __construct(UserRepositoryInterface $userRepository,
                                TaskRepositoryInterface $taskRepository)
    {
        $this->userRepository = $userRepository;
        $this->taskRepository = $taskRepository;
    }

    /**
     * Compose admin panel views.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('users', $this->userRepository->getPaginatedUsers(25));
        $view->with('userCount', $this->userRepository->all()->count());
        $view->with('tasks', $this->taskRepository->getPaginatedTasks(40));
        $view->with('taskCount', $this->taskRepository->all()->count());
    }
}