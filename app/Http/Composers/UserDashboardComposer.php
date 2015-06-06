<?php
namespace Keep\Http\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Auth\Guard;

class UserDashboardComposer
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function compose(View $view)
    {
        $totalTasksCount = $this->auth->user()->tasks()->count();
        $view->with('totalTasksCount', $totalTasksCount);

        $completedTasksCount = $this->auth->user()->tasks()->completed()->count();
        $view->with('completedTasksCount', $completedTasksCount);

        $failedTasksCount = $this->auth->user()->tasks()->where('is_failed', 1)->count();
        $view->with('failedTasksCount', $failedTasksCount);

        $dueTasksCount = $totalTasksCount - $completedTasksCount - $failedTasksCount;
        $view->with('dueTasksCount', $dueTasksCount);
    }
}