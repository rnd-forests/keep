<?php

namespace Keep\Repositories\User;

use Gate;
use Keep\Entities\User;
use Keep\Repositories\EloquentRepository;

class EloquentUserRepository extends EloquentRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function fetchPaginatedUsers(array $params, $limit)
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

    public function findBySlugEagerLoadTasks($slug)
    {
        return $this->model->with(['tasks' => function ($query) {
            $query->latest('created_at');
        }, 'roles'])->where('slug', $slug)->firstOrFail();
    }

    public function findByActivationCode($code, $active = false)
    {
        return $this->model
            ->where('activation_code', $code)
            ->where('active', $active)
            ->firstOrFail();
    }

    public function create(array $credentials)
    {
        return $this->model->create([
            'name'            => $credentials['name'],
            'email'           => $credentials['email'],
            'password'        => $credentials['password'],
            'activation_code' => str_random(100),
        ]);
    }

    public function updateProfile(array $credentials, $slug)
    {
        $user = $this->findBySlug($slug);
        if (Gate::denies('updateAccountAndProfile', $user)) {
            abort(403);
        }
        $user->profile()->update($credentials);
    }

    public function restore($slug)
    {
        $user = $this->findDisabledUserBySlug($slug);
        $user->restore();
    }

    public function softDelete($slug)
    {
        $user = $this->findBySlug($slug);
        if (Gate::denies('updateAccountAndProfile', $user)) {
            abort(403);
        }
        $user->delete();
    }

    public function forceDelete($slug)
    {
        $user = $this->findDisabledUserBySlug($slug);
        $user->tasks()->withTrashed()->forceDelete();
        $user->profile()->withTrashed()->forceDelete();
        $user->forceDelete();
    }

    public function fetchDisabledUsers($limit)
    {
        return $this->model
            ->onlyTrashed()
            ->latest('deleted_at')
            ->paginate($limit);
    }

    public function findDisabledUserBySlug($slug)
    {
        return $this->model
            ->onlyTrashed()
            ->where('slug', $slug)
            ->firstOrFail();
    }

    public function fetchUsersByIds(array $ids)
    {
        return $this->model->whereIn('id', $ids)->get();
    }

    public function findOrCreateNew(array $userData, $authProvider)
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
                'auth_provider'   => $authProvider,
                'active'          => true,
                'activation_code' => '',
            ]);
        }

        return $user;
    }
}
