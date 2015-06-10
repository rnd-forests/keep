<?php
namespace Keep\Mailers;

use Carbon\Carbon;
use Keep\Entities\Task;
use Keep\Entities\User;

class UserMailer extends Mailer
{
    /**
     * Send account activation link.
     *
     * @param User $user
     * @param      $activationCode
     */
    public function sendAccountActivationLink(User $user, $activationCode)
    {
        $subject = 'Account Activation';
        $view = 'emails.auth.account_activation';
        $data = ['activationLink' => route('account.activation', $activationCode)];
        $this->sendTo($user, $subject, $view, $data);
    }
    
    /**
     * Send notification about newly created task.
     *
     * @param User $user
     * @param Task $task
     */
    public function sendNotificationAboutNewTask(User $user, Task $task)
    {
        $subject = 'Keep - New task notification';
        $view = 'emails.task.new_task';
        $data = [
            'username'      => $user->name,
            'taskTitle'     => $task->title,
            'taskContent'   => $task->content,
            'startingDate'  => Carbon::parse($task->starting_date)->format('Y-m-d'),
            'finishingDate' => Carbon::parse($task->finishing_date)->format('Y-m-d'),
            'taskUrl'       => $task->present()->url($user, $task)
        ];
        $this->sendTo($user, $subject, $view, $data);
    }

    /**
     * Send notification to users about their upcoming task.
     *
     * @param User $user
     * @param Task $task
     */
    public function sendNotificationAboutUpcomingTask(User $user, Task $task)
    {
        $subject = 'Keep - Upcoming task notification';
        $view = 'emails.task.upcoming_task';
        $data = [
            'username'      => $user->name,
            'taskTitle'     => $task->title,
            'taskContent'   => $task->content,
            'startingDate'  => Carbon::parse($task->starting_date)->format('Y-m-d'),
            'finishingDate' => Carbon::parse($task->finishing_date)->format('Y-m-d'),
            'remainingDays' => $task->present()->getRemainingDays($task->finishing_date),
            'taskUrl'       => $task->present()->url($user, $task)
        ];
        $this->sendTo($user, $subject, $view, $data);
    }
}