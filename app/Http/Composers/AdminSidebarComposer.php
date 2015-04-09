<?php  namespace Keep\Http\Composers; 

use App;
use Illuminate\Contracts\View\View;

class AdminSidebarComposer {

    /**
     * Compose admin sidebar view.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $users = App::make('Keep\Repositories\User\UserRepositoryInterface');

        $view->with('user', $users->getAuthUser());
    }

}