<?php namespace Keep\Http\Composers;

use App;
use Illuminate\Contracts\View\View;

class CreateGroupNotificationFormComposer {

    /**
     * Composer group assignment creation form view.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $groupRepo = App::make('Keep\Repositories\UserGroup\UserGroupRepositoryInterface');
        $view->with('groups', $groupRepo->all()->lists('name', 'id'));
    }

}