<?php
namespace Keep\Http\ViewComposers;

use Illuminate\Contracts\View\View;

class UserDashboard
{
    public function compose(View $view)
    {
        $totalTasksCount = auth()->user()->tasks()->count();
        $view->with('totalTasksCount', $totalTasksCount);

        $completedTasksCount = auth()->user()->tasks()->completed()->count();
        $view->with('completedTasksCount', $completedTasksCount);

        $failedTasksCount = auth()->user()->tasks()->where('is_failed', 1)->count();
        $view->with('failedTasksCount', $failedTasksCount);

        $dueTasksCount = $totalTasksCount - $completedTasksCount - $failedTasksCount;
        $view->with('dueTasksCount', $dueTasksCount);
    }
}