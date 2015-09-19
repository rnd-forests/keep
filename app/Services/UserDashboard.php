<?php

namespace Keep\Services;

use Illuminate\Contracts\Auth\Guard;

class UserDashboard
{
    protected $currentUser;

    public function __construct(Guard $auth)
    {
        $this->currentUser = $auth->user();
    }

    /**
     * Count the number of all tasks for current authenticated user.
     *
     * @return mixed
     */
    public function totalTasks()
    {
        return $this->currentUser->tasks()->count();
    }

    /**
     * Count the number of completed tasks for current authenticated user.
     *
     * @return mixed
     */
    public function countCompletedTasks()
    {
        return $this->currentUser->tasks()->completed()->count();
    }

    /**
     * Count the number of failed tasks for current authenticated user.
     *
     * @return mixed
     */
    public function countFailedTasks()
    {
        return $this->currentUser->tasks()->recentlyFailed()->count();
    }

    /**
     * Count the number of processing tasks for current authenticated user.
     *
     * @return mixed
     */
    public function countDueTasks()
    {
        return $this->currentUser->tasks()->due()->count();
    }

    /**
     * Return the percentage of completed tasks.
     *
     * @return float
     */
    public function completedPercentage()
    {
        return round($this->currentUser->tasks()->completed()->count() /
            $this->currentUser->tasks()->count() * 100);
    }

    /**
     * Return the percentage of processing tasks.
     *
     * @return float
     */
    public function processingPercentage()
    {
        return round($this->currentUser->tasks()->due()->count() /
            $this->currentUser->tasks()->count() * 100);
    }
}