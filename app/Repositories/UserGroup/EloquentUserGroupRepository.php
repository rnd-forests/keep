<?php namespace Keep\Repositories\UserGroup;

use Keep\Entities\User;
use Keep\Entities\Group;
use Keep\Services\KeepHelper;
use Keep\Repositories\DbRepository;

class EloquentUserGroupRepository extends DbRepository implements UserGroupRepositoryInterface {

    protected $model;

    public function __construct(Group $model)
    {
        $this->model = $model;
    }

    public function getPaginatedGroups($limit)
    {
        return $this->model
            ->with('users')
            ->latest('created_at')
            ->paginate($limit);
    }

    public function findBySlug($slug)
    {
        return $this->model
            ->with('users', 'assignments.task')
            ->where('slug', $slug)
            ->firstOrFail();
    }

    public function create(array $data)
    {
        return $this->model->create([
            'name'        => $data['name'],
            'description' => $data['description']
        ]);
    }

    public function update($slug, array $data)
    {
        $group = $this->findBySlug($slug);
        $group->update($data);
        return $group;
    }

    public function restore($slug)
    {
        $group = $this->findTrashedGroupBySlug($slug);
        return $group->restore();
    }

    public function softDelete($slug)
    {
        return $this->findBySlug($slug)->delete();
    }

    public function forceDelete($slug)
    {
        $group = $this->findTrashedGroupBySlug($slug);
        $group->forceDelete();
    }

    public function getTrashedGroups($limit)
    {
        return $this->model
            ->with('users')
            ->onlyTrashed()
            ->latest('deleted_at')
            ->paginate($limit);
    }

    public function findTrashedGroupBySlug($slug)
    {
        return $this->model
            ->onlyTrashed()
            ->where('slug', $slug)
            ->firstOrFail();
    }

    public function getPaginatedAssociatedUsers(Group $group, $limit)
    {
        return $group->users()
            ->oldest('name')
            ->paginate($limit);
    }

    public function getUsersOutsideGroup($slug)
    {
        return User::whereNotIn(
            'id', KeepHelper::getUserIdsRelatedToGroup($this->findBySlug($slug))
        )->oldest('name')->get();
    }

    public function attachUsers(Group $group, array $users)
    {
        $group->users()->attach($users);
    }

    public function fetchGroupsByIds(array $ids)
    {
        return $this->model->whereIn('id', $ids)->get();
    }

    public function getGroupsAssociatedWithAUser($userSlug)
    {
        $user = User::findBySlug($userSlug);
        return $user->groups()->paginate(10);
    }

    public function getMembersOfGroup($groupSlug)
    {
        $group = $this->findBySlug($groupSlug);
        return $group->users()->latest('created_at')->get();
    }

    public function getAssignmentsOfGroup($groupSlug)
    {
        $group = $this->findBySlug($groupSlug);
        return $group->assignments()->latest('created_at')->get();
    }

}