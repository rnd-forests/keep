<?php  namespace Keep\Http\Controllers\Admin; 

use Keep\Http\Controllers\Controller;

class TasksController extends Controller {

    /**
     * Get tasks management page.
     *
     * @return \Illuminate\View\View
     */
    public function manageTasks()
    {
        return view('admin.manage-tasks');
    }
}