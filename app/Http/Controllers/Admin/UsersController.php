<?php  namespace Keep\Http\Controllers\Admin; 

use Keep\Http\Controllers\Controller;
use Keep\Repositories\Task\TaskRepositoryInterface;
use Keep\Repositories\User\UserRepositoryInterface;

class UsersController extends Controller {

    protected $userRepository;
    protected $taskRepository;

    public function __construct(UserRepositoryInterface $userRepository,
                                TaskRepositoryInterface $taskRepository)
    {
        $this->userRepository = $userRepository;
        $this->taskRepository = $taskRepository;
    }

    public function members()
    {
        $users = $this->userRepository->all();
        $user = $this->userRepository->getAuthUser();
        return view('admin.manage_users', compact('user', 'users'));
    }
}