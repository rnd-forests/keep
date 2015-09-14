<?php

namespace Keep\Repositories;

use Keep\Entities\User;
use Keep\Entities\Group;
use Keep\Repositories\Contracts\Common\Findable;
use Keep\Repositories\Contracts\Common\Removable;
use Keep\Repositories\Contracts\Common\Updateable;
use Keep\Repositories\Contracts\Common\Paginateable;
use Keep\Repositories\Contracts\GroupRepositoryInterface;
use Keep\Repositories\Contracts\Common\RepositoryInterface;

class EloquentGroupRepository extends AbstractEloquentRepository implements
    Findable,
    Removable,
    Updateable,
    Paginateable,
    RepositoryInterface,
    GroupRepositoryInterface
{
    protected $model;

    public function __construct(Group $model)
    {
        $this->model = $model;
    }

    public function paginate($limit, array $params = null)
    {
        return $this->model
            ->with('users')
            ->latest('created_at')
            ->paginate($limit);
    }

    public function findBySlug($slug)
    {
        return $this->model
            ->with('users')
            ->where('slug', $slug)
            ->firstOrFail();
    }

    public function create(array $data)
    {
        return $this->model->create([
            'name' => $data['name'],
            'description' => $data['description'],
        ]);
    }

    public function update(array $data, $identifier1, $identifier2 = null)
    {
        $group = $this->findBySlug($identifier1);
        $group->update($data);

        return $group;
    }

    public function restore($slug)
    {
        $group = $this->findTrashedGroup($slug);

        return $group->restore();
    }

    public function softDelete($slug)
    {
        return $this->findBySlug($slug)->delete();
    }

    public function forceDelete($slug)
    {
        $group = $this->findTrashedGroup($slug);
        $group->forceDelete();
    }

    public function trashed($limit)
    {
        return $this->model
            ->with('users')
            ->onlyTrashed()
            ->latest('deleted_at')
            ->paginate($limit);
    }

    public function findTrashedGroup($slug)
    {
        return $this->model
            ->onlyTrashed()
            ->where('slug', $slug)
            ->firstOrFail();
    }

    public function associatedUsers($group, $limit)
    {
        return $group->users()
            ->oldest('name')
            ->paginate($limit);
    }

    public function outsiders($slug)
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

    public function fetchByIds(array $ids)
    {
        return $this->model->whereIn('id', $ids)->get();
    }

    public function joinedGroups($userSlug)
    {
        $user = User::findBySlug($userSlug);

        return $user->groups()->paginate(10);
    }

    public function fetchMembers($groupSlug)
    {
        $group = $this->findBySlug($groupSlug);

        return $group->users()->latest('created_at')->get();
    }
}
