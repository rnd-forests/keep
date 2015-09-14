<?php

namespace Keep\Repositories;

use Gate;
use Keep\Entities\User;
use Keep\Repositories\Contracts\Common\Findable;
use Keep\Repositories\Contracts\Common\Removable;
use Keep\Repositories\Contracts\Common\Updateable;
use Keep\Repositories\Contracts\Common\Paginateable;
use Keep\Repositories\Contracts\UserRepositoryInterface;
use Keep\Repositories\Contracts\Common\RepositoryInterface;

class EloquentUserRepository extends AbstractEloquentRepository implements
    Findable,
    Removable,
    Updateable,
    Paginateable,
    RepositoryInterface,
    UserRepositoryInterface
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

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

    public function restore($identifier)
    {
        $user = $this->findDisabledUser($identifier);
        $user->restore();
    }

    public function softDelete($identifier)
    {
        $user = $this->findBySlug($identifier);
        if (Gate::denies('updateAccountAndProfile', $user)) {
            abort(403);
        }
        $user->delete();
    }

    public function forceDelete($identifier)
    {
        $user = $this->findDisabledUser($identifier);
        $user->tasks()->withTrashed()->forceDelete();
        $user->profile()->withTrashed()->forceDelete();
        $user->forceDelete();
    }

    public function create(array $data)
    {
        return $this->model->create([
            'name'            => $data['name'],
            'email'           => $data['email'],
            'password'        => $data['password'],
            'activation_code' => str_random(100),
        ]);
    }

    public function update(array $data, $identifier1, $identifier2 = null)
    {
        $user = $this->findBySlug($identifier1);
        if (Gate::denies('updateAccountAndProfile', $user)) {
            abort(403);
        }
        $user->profile()->update($data);
    }

    public function disabled()
    {
        return $this->model
            ->onlyTrashed()
            ->latest('deleted_at')
            ->paginate(25);
    }

    public function fetchByIds(array $ids)
    {
        return $this->model->whereIn('id', $ids)->get();
    }

    public function findDisabledUser($slug)
    {
        return $this->model
            ->onlyTrashed()
            ->where('slug', $slug)
            ->firstOrFail();
    }

    public function findBySlugWithTasks($slug)
    {
        return $this->model->with(['tasks' => function ($query) {
            $query->latest('created_at');
        }, 'roles'])->where('slug', $slug)->firstOrFail();
    }

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
                'auth_provider'   => $authProvider,
                'active'          => true,
                'activation_code' => '',
            ]);
        }

        return $user;
    }

    public function findByActivationCode($code, $active = false)
    {
        return $this->model
            ->where('activation_code', $code)
            ->where('active', $active)
            ->firstOrFail();
    }
}
