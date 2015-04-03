<?php  namespace Keep\Http\Controllers\Admin; 

use Keep\Http\Controllers\Controller;

class DashboardController extends Controller {

    /**
     * Get dashboard page.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

}