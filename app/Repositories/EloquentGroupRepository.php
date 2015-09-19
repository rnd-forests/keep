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

    /**
     * Fetching trashed groups.
     *
     * @param $limit
     * @return mixed
     */
    public function trashed($limit)
    {
        return $this->model
            ->with('users')
            ->onlyTrashed()
            ->latest('deleted_at')
            ->paginate($limit);
    }

    /**
     * Finding a trashed group.
     *
     * @param $slug
     * @return mixed
     */
    public function findTrashedGroup($slug)
    {
        return $this->model
            ->onlyTrashed()
            ->where('slug', $slug)
            ->firstOrFail();
    }

    /**
     * Finding associated users of a group.
     *
     * @param $group
     * @param $limit
     * @return mixed
     */
    public function associatedUsers($group, $limit)
    {
        return $group->users()
            ->oldest('name')
            ->paginate($limit);
    }

    /**
     * Finding users who do not belong to a group.
     *
     * @param $slug
     * @return mixed
     */
    public function outsiders($slug)
    {
        $group = $this->findBySlug($slug);
        $ids = $group->users->lists('id')->toArray();

        return User::whereNotIn('id', $ids)
            ->oldest('name')->get();
    }

    /**
     * Adding users to a group.
     *
     * @param $group
     * @param array $users
     * @return mixed
     */
    public function attachUsers($group, array $users)
    {
        $group->users()->attach($users);
    }

    /**
     * Fetching a collection of users using an array of ids.
     *
     * @param array $ids
     * @return mixed
     */
    public function fetchByIds(array $ids)
    {
        return $this->model->whereIn('id', $ids)->get();
    }

    /**
     * Fetching groups of a user.
     *
     * @param $userSlug
     * @return mixed
     */
    public function joinedGroups($userSlug)
    {
        $user = User::findBySlug($userSlug);

        return $user->groups()->paginate(10);
    }

    /**
     * Fetching members of a group.
     *
     * @param $groupSlug
     * @return mixed
     */
    public function fetchMembers($groupSlug)
    {
        $group = $this->findBySlug($groupSlug);

        return $group->users()->latest('created_at')->get();
    }

    /**
     * Paginate a collection of models.
     *
     * @param $limit
     * @param array|null $params
     * @return mixed
     */
    public function paginate($limit, array $params = null)
    {
        return $this->model
            ->with('users')
            ->latest('created_at')
            ->paginate($limit);
    }

    /**
     * Restore a soft deleted model instance.
     *
     * @param $identifier
     * @return mixed
     */
    public function restore($identifier)
    {
        $group = $this->findTrashedGroup($identifier);

        return $group->restore();
    }

    /**
     * Soft delete a model instance.
     *
     * @param $identifier
     * @return mixed
     */
    public function softDelete($identifier)
    {
        return $this->findBySlug($identifier)->delete();
    }

    /**
     * Permanently delete a soft deleted model instance.
     *
     * @param $identifier
     * @return mixed
     */
    public function forceDelete($identifier)
    {
        $group = $this->findTrashedGroup($identifier);
        $group->forceDelete();
    }

    /**
     * Create a new model instance.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create([
            'name' => $data['name'],
            'description' => $data['description'],
        ]);
    }

    /**
     * Update a model instance.
     *
     * @param array $data
     * @param $identifier
     * @param null $optionalIdentifier
     * @return mixed
     */
    public function update(array $data, $identifier, $optionalIdentifier = null)
    {
        $group = $this->findBySlug($identifier);
        $group->update($data);

        return $group;
    }

    /**
     * Find a model instance by its slug.
     *
     * @param $slug
     * @return mixed
     */
    public function findBySlug($slug)
    {
        return $this->model
            ->with('users')
            ->where('slug', $slug)
            ->firstOrFail();
    }
}
