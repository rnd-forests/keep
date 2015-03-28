<?php  namespace Keep\Http\Composers; 

use Illuminate\Contracts\View\View;
use Keep\Repositories\Task\TaskRepositoryInterface;
use Keep\Repositories\User\UserRepositoryInterface;

class AdminPanelComposer {

    protected $userRepository;
    protected $taskRepository;

    public function __construct(UserRepositoryInterface $userRepository,
                                TaskRepositoryInterface $taskRepository)
    {
        $this->userRepository = $userRepository;
        $this->taskRepository = $taskRepository;
    }

    /**
     * Compose admin panel view.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('adminUser', $this->userRepository->getAuthUser());
        $view->with('userList', $this->userRepository->all());
        $view->with('taskList', $this->taskRepository->all());
    }
}