<?php  namespace Keep\Http\Composers; 

use Illuminate\Contracts\View\View;
use Keep\Repositories\User\UserRepositoryInterface;

class AdminSidebarComposer {

    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function compose(View $view)
    {
        $view->with('user', $this->userRepository->getAuthUser());
    }

}