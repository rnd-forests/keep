<?php

namespace Keep\Repositories;

use Keep\Entities\User;
use Keep\Entities\Group;
use Keep\Repositories\Contracts\GroupRepository;
use Keep\Repositories\Contracts\Common\CanBeRemoved;
use Keep\Repositories\Contracts\Common\CanBeUpdated;
use Keep\Repositories\Contracts\Common\ShouldBeFound;
use Keep\Repositories\Contracts\Common\ModelRepository;
use Keep\Repositories\Contracts\Common\ShouldBePaginated;

class EloquentGroupRepository extends AbstractRepository implements
    ShouldBeFound,
    CanBeRemoved,
    CanBeUpdated,
    ShouldBePaginated,
    ModelRepository,
    GroupRepository
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
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
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
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
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
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
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
     * @return \Illuminate\Database\Eloquent\Collection
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
     * @return void
     */
    public function attachUsers($group, array $users)
    {
        $group->users()->attach($users);
    }

    /**
     * Fetching a collection of users using an array of ids.
     *
     * @param array $ids
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fetchByIds(array $ids)
    {
        return $this->model->whereIn('id', $ids)->get();
    }

    /**
     * Fetching groups of a user.
     *
     * @param $userSlug
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
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
     * @return \Illuminate\Database\Eloquent\Collection
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
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
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
     * @return bool|null
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
     * @return bool|null
     */
    public function softDelete($identifier)
    {
        return $this->findBySlug($identifier)->delete();
    }

    /**
     * Permanently delete a soft deleted model instance.
     *
     * @param $identifier
     * @return void
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
     * @return static
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
     * @return bool|int
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
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findBySlug($slug)
    {
        return $this->model
            ->with('users')
            ->where('slug', $slug)
            ->firstOrFail();
    }
}
