<?php

namespace Keep\Repositories;

use Keep\Entities\User;
use Keep\Repositories\Contracts\UserRepository;
use Keep\Repositories\Contracts\Common\CanBeRemoved;
use Keep\Repositories\Contracts\Common\CanBeUpdated;
use Keep\Repositories\Contracts\Common\ShouldBeFound;
use Keep\Repositories\Contracts\Common\ModelRepository;
use Keep\Repositories\Contracts\Common\ShouldBePaginated;

class EloquentUserRepository extends AbstractRepository implements
    ShouldBeFound,
    CanBeRemoved,
    CanBeUpdated,
    ShouldBePaginated,
    ModelRepository,
    UserRepository
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
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
        if ($this->isSortable($params)) {
            return $this->model
                ->with('tasks', 'roles', 'groups')
                ->orderBy($params['sortBy'], $params['direction'])
                ->paginate($limit);
        }

        return $this->model
            ->with('tasks', 'roles', 'groups')
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
        $user = $this->findDisabledUser($identifier);
        $user->restore();
    }

    /**
     * Soft delete a model instance.
     *
     * @param $identifier
     * @return bool|null
     */
    public function softDelete($identifier)
    {
        $user = $this->findBySlug($identifier);
        $user->delete();
    }

    /**
     * Permanently delete a soft deleted model instance.
     *
     * @param $identifier
     * @return void
     */
    public function forceDelete($identifier)
    {
        $user = $this->findDisabledUser($identifier);
        $user->tasks()->withTrashed()->forceDelete();
        $user->profile()->withTrashed()->forceDelete();
        $user->forceDelete();
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
            'email' => $data['email'],
            'password' => $data['password'],
            'activation_code' => str_random(100),
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
        $user = $this->findBySlug($identifier);
        $user->profile()->update($data);
    }

    /**
     * Fetching a paginated collection of disabled users.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function disabled()
    {
        return $this->model
            ->onlyTrashed()
            ->latest('deleted_at')
            ->paginate(25);
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
     * Finding a disabled user.
     *
     * @param $slug
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findDisabledUser($slug)
    {
        return $this->model
            ->onlyTrashed()
            ->where('slug', $slug)
            ->firstOrFail();
    }

    /**
     * Fetching a user and user's associated tasks.
     *
     * @param $slug
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findBySlugWithTasks($slug)
    {
        return $this->model->with(['tasks' => function ($query) {
            $query->latest('created_at');
        }, 'roles'])->where('slug', $slug)->firstOrFail();
    }

    /**
     * Finding a user or creating a new user if the user does not exist.
     *
     * @param array $userData
     * @param $authProvider
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findOrCreate(array $userData, $authProvider)
    {
        $user = $this->model
            ->where('auth_provider_id', $userData['auth_provider_id'])
            ->first();
        $userExisted = $this->model
            ->where('email', $userData['email'])
            ->first();
        if (!$user && $userExisted) {
            return false;
        }
        if (!$user) {
            $user = $this->model->create($userData);
            $user->update([
                'auth_provider' => $authProvider,
                'active' => true,
                'activation_code' => '',
            ]);
        }

        return $user;
    }

    /**
     * Find a user by activation code.
     *
     * @param $code
     * @param bool|false $active
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findByActivationCode($code, $active = false)
    {
        return $this->model
            ->where('activation_code', $code)
            ->where('active', $active)
            ->firstOrFail();
    }
}
