<?php
namespace Keep\Services;

class UserDashboardService
{
    public function totalTasks()
    {
        return auth()->user()->tasks()->count();
    }

    public function countCompletedTasks()
    {
        return auth()->user()->tasks()->completed()->count();
    }

    public function countFailedTasks()
    {
        return auth()->user()->tasks()->recentlyFailed()->count();
    }

    public function countDueTasks()
    {
        return auth()->user()->tasks()->due()->count();
    }
}
