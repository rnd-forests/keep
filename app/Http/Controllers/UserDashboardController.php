<?php namespace Keep\Http\Controllers;

use Keep\Repositories\User\UserRepositoryInterface;

class UserDashboardController extends Controller {

    protected $userRepo;

    /**
     * Create new user dashboard controller instance.
     *
     * @param UserRepositoryInterface $userRepo
     */
    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;

        $this->middleware('auth');
        $this->middleware('auth.correct');
    }

    /**
     * User dashboard.
     *
     * @param $userSlug
     *
     * @return \Illuminate\View\View
     */
	public function dashboard($userSlug)
    {
        $user = $this->userRepo->findBySlug($userSlug);

        $tasks = $this->userRepo->getPaginatedAssociatedTasks($user, 10);

        return view('users.dashboard', compact('user', 'tasks'));
    }

}
