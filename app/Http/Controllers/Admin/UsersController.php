<?php  namespace Keep\Http\Controllers\Admin; 

use Keep\Http\Controllers\Controller;

class UsersController extends Controller {

    /**
     * Get members management page.
     *
     * @return \Illuminate\View\View
     */
    public function members()
    {
        return view('admin.manage_users');
    }

}