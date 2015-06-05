<?php namespace Keep\Http\Composers;

use App;
use Illuminate\Contracts\View\View;

class CreateMemberAssignmentFormComposer {

    /**
     * Composer member assignment creation form view.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $userRepo = App::make('Keep\Repositories\User\UserRepositoryInterface');
        $view->with('users', $userRepo->getAll()->lists('name', 'id'));
    }

}