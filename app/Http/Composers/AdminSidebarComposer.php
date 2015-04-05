<?php  namespace Keep\Http\Composers; 

use Illuminate\Contracts\View\View;
use Keep\Repositories\User\UserRepositoryInterface;

class AdminSidebarComposer {

    protected $userRepository;

    /**
     * Constructor.
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Compose admin sidebar view.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('user', $this->userRepository->getAuthUser());
    }

}