<?php
namespace Keep\Jobs;

use Keep\Jobs\Traits\NotificationTrait;
use Illuminate\Contracts\Bus\SelfHandling;
use Keep\Repositories\Notification\NotificationRepositoryInterface;
use Keep\Repositories\User\UserRepositoryInterface;

class CreateMemberNotification extends Job implements SelfHandling
{
    use NotificationTrait;

    protected $type, $body, $subject, $userList;

    /**
     * Create a new job instance.
     *
     * @param $type
     * @param $body
     * @param $subject
     * @param $user_list
     */
    public function __construct($type, $body, $subject, $user_list)
    {
        $this->type = $type;
        $this->body = $body;
        $this->subject = $subject;
        $this->userList = $user_list;
    }

    /**
     * Execute the job.
     *
     * @param NotificationRepositoryInterface $notiRepo
     * @param UserRepositoryInterface         $userRepo
     */
    public function handle(NotificationRepositoryInterface $notiRepo,
                           UserRepositoryInterface $userRepo)
    {
        $notification = $notiRepo->create($this->getNotificationRequestData());
        $users = $userRepo->fetchUsersByIds($this->userList);
        $this->setNotificationPolymorphic($notification, $users);
    }
}
