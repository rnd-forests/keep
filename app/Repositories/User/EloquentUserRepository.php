<?php
namespace Keep\Repositories\User;

use Keep\Entities\User;
use Keep\Repositories\DbRepository;

class EloquentUserRepository extends DbRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getPaginatedUsers($limit, array $params)
    {
        if ($this->isSortable($params)) {
            return $this->model->with('tasks', 'roles', 'groups', 'assignments')
                ->orderBy($params['sortBy'], $params['direction'])
                ->paginate($limit);
        }

        return $this->model
            ->with('tasks', 'roles', 'groups', 'assignments')
            ->paginate($limit);
    }

    public function findBySlugWithTasks($slug)
    {
        return $this->model->with(['tasks' => function ($query) {
            $query->latest('created_at');
        }, 'roles'])->where('slug', $slug)->firstOrFail();
    }

    public function findByCodeAndActiveState($code, $state)
    {
        return $this->model
            ->where('activation_code', $code)
            ->where('active', $state)
            ->firstOrFail();
    }

    public function create(array $credentials)
    {
        return $this->model->create([
            'name'            => $credentials['name'],
            'email'           => $credentials['email'],
            'password'        => $credentials['password'],
            'activation_code' => str_random(60)
        ]);
    }

    public function updateProfile($slug, array $credentials)
    {
        $user = $this->findBySlug($slug);
        $user->profile()->update($credentials);

        return $user;
    }

    public function restore($slug)
    {
        $user = $this->findTrashedUserBySlug($slug);
        $user->tasks()->withTrashed()->get()->each(function ($task) {
            $task->restore();
        });
        $user->profile()->withTrashed()->restore();

        return $user->restore();
    }

    public function softDelete($slug)
    {
        $user = $this->findBySlug($slug);
        $user->tasks()->get()->each(function ($task) {
            $task->delete();
        });
        $user->profile()->delete();

        return $user->delete();
    }

    public function forceDelete($slug)
    {
        $user = $this->findTrashedUserBySlug($slug);
        $user->tasks()->withTrashed()->forceDelete();
        $user->profile()->withTrashed()->forceDelete();

        return $user->forceDelete();
    }

    public function getTrashedUsers($limit)
    {
        return $this->model
            ->onlyTrashed()
            ->latest('deleted_at')
            ->paginate($limit);
    }

    public function findTrashedUserBySlug($slug)
    {
        return $this->model
            ->onlyTrashed()
            ->where('slug', $slug)
            ->firstOrFail();
    }

    public function getPaginatedAssociatedTasks(User $user, $limit)
    {
        return $user->tasks()
            ->latest('created_at')
            ->paginate($limit);
    }

    public function fetchUsersByIds(array $ids)
    {
        return $this->model->whereIn('id', $ids)->get();
    }

    public function findOrCreateNew(array $userData, $provider)
    {
        $user = $this->model->where('auth_provider_id', $userData['auth_provider_id'])->first();
        $existed = $this->model->where('email', $userData['email'])->first();
        if ( ! $user && $existed) {
            return false;
        }
        if ( ! $user) {
            $user = $this->model->create($userData);
            $user->update([
                'auth_provider'   => $provider,
                'active'          => true,
                'activation_code' => ''
            ]);
        }

        return $user;
    }
}