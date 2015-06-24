<?php
namespace Keep\Repositories\UserGroup;

use Keep\Entities\User;
use Keep\Entities\Group;
use Keep\Repositories\EloquentRepository;

class EloquentUserGroupRepository extends EloquentRepository implements UserGroupRepositoryInterface
{
    protected $model;

    public function __construct(Group $model)
    {
        $this->model = $model;
    }

    public function fetchPaginatedGroups($limit)
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

    public function fetchTrashedGroups($limit)
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

    public function fetchPaginatedAssociatedUsers($group, $limit)
    {
        return $group->users()
            ->oldest('name')
            ->paginate($limit);
    }

    public function fetchOutsiders($slug)
    {
        $group = $this->findBySlug($slug);
        $ids = $group->users->lists('id')->toArray();

        return User::whereNotIn('id', $ids)
            ->oldest('name')->get();
    }

    public function attachUsers($group, array $users)
    {
        $group->users()->attach($users);
    }

    public function fetchGroupsByIds(array $ids)
    {
        return $this->model->whereIn('id', $ids)->get();
    }

    public function fetchGroupsOfUser($userSlug)
    {
        $user = User::findBySlug($userSlug);

        return $user->groups()->paginate(10);
    }

    public function fetchMembersOfGroup($groupSlug)
    {
        $group = $this->findBySlug($groupSlug);

        return $group->users()->latest('created_at')->get();
    }

    public function fetchAssignmentsOfGroup($groupSlug)
    {
        $group = $this->findBySlug($groupSlug);

        return $group->assignments()->latest('created_at')->get();
    }
}
