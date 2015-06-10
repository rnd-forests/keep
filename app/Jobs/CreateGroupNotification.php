<?php
namespace Keep\Jobs;

use Keep\Jobs\Traits\NotificationTrait;
use Illuminate\Contracts\Bus\SelfHandling;
use Keep\Repositories\UserGroup\UserGroupRepositoryInterface;
use Keep\Repositories\Notification\NotificationRepositoryInterface;

class CreateGroupNotification extends Job implements SelfHandling
{
    use NotificationTrait;

    protected $type, $body, $subject, $groupList;

    /**
     * Create a new job instance.
     *
     * @param $type
     * @param $body
     * @param $subject
     * @param $group_list
     */
    public function __construct($type, $body, $subject, $group_list)
    {
        $this->type = $type;
        $this->body = $body;
        $this->subject = $subject;
        $this->groupList = $group_list;
    }

    /**
     * Execute the job.
     *
     * @param NotificationRepositoryInterface $notiRepo
     * @param UserGroupRepositoryInterface    $groupRepo
     */
    public function handle(NotificationRepositoryInterface $notiRepo,
                           UserGroupRepositoryInterface $groupRepo)
    {
        $notification = $notiRepo->create($this->getNotificationRequestData());
        $groups = $groupRepo->fetchGroupsByIds($this->groupList);
        $this->setNotificationPolymorphic($notification, $groups);
    }
}
