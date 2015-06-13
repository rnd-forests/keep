<?php
namespace Keep\Presenters;

use Carbon\Carbon;
use Laracasts\Presenter\Presenter;

class TaskPresenter extends Presenter
{
    /**
     * Print task status.
     *
     * @param $status
     *
     * @return string
     */
    public function printStatus($status)
    {
        if ($status) {
            return '<i class="text-primary fa fa-check"></i>';
        }

        return '<i class="text-danger fa fa-times"></i>';
    }

    /**
     * Get the url to a task.
     *
     * @param $user
     * @param $task
     *
     * @return string
     */
    public function url($user, $task)
    {
        return route('member::tasks.show', [$user, $task]);
    }
}