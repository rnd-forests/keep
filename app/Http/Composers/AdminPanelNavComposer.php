<?php  namespace Keep\Http\Composers; 

use Illuminate\Contracts\View\View;
use Keep\Repositories\User\UserRepositoryInterface;

class AdminPanelNavComposer {

    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Composer admin panel navigation view.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('user', $this->userRepository->getAuthUser());
    }

}