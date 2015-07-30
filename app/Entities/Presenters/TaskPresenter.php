<?php

namespace Keep\Entities\Presenters;

class TaskPresenter extends Presenter
{
    /**
     * Print task status.
     *
     * @param $status
     * @return string
     */
    public function printStatus($status)
    {
        if ($status) {
            return trans('presenter.completed');
        }

        return trans('presenter.not_completed');
    }

    /**
     * Get the url to a task.
     *
     * @param $user
     * @param $task
     * @return string
     */
    public function url($user, $task)
    {
        return route('member::tasks.show', [$user, $task]);
    }
}
