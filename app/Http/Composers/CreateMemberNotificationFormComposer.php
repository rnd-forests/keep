<?php namespace Keep\Http\Composers;

use App;
use Illuminate\Contracts\View\View;

class CreateMemberNotificationFormComposer {

    /**
     * Composer member notification creation form view.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $userRepo = App::make('Keep\Repositories\User\UserRepositoryInterface');
        $view->with('users', $userRepo->all()->lists('name', 'id'));
    }

}