<?php

namespace Keep\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerRepositories();
    }

    /**
     * Bind all repository interfaces to their concrete implementations.
     */
    protected function registerRepositories()
    {
        $this->app->singleton(
            'Keep\Repositories\Tag\TagRepositoryInterface',
            'Keep\Repositories\Tag\EloquentTagRepository'
        );

        $this->app->singleton(
            'Keep\Repositories\Task\TaskRepositoryInterface',
            'Keep\Repositories\Task\EloquentTaskRepository'
        );

        $this->app->singleton(
            'Keep\Repositories\User\UserRepositoryInterface',
            'Keep\Repositories\User\EloquentUserRepository'
        );

        $this->app->singleton(
            'Keep\Repositories\Priority\PriorityRepositoryInterface',
            'Keep\Repositories\Priority\EloquentPriorityRepository'
        );

        $this->app->singleton(
            'Keep\Repositories\UserGroup\UserGroupRepositoryInterface',
            'Keep\Repositories\UserGroup\EloquentUserGroupRepository'
        );

        $this->app->singleton(
            'Keep\Repositories\Assignment\AssignmentRepositoryInterface',
            'Keep\Repositories\Assignment\EloquentAssignmentRepository'
        );

        $this->app->singleton(
            'Keep\Repositories\Notification\NotificationRepositoryInterface',
            'Keep\Repositories\Notification\EloquentNotificationRepository'
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'Keep\Repositories\Tag\TagRepositoryInterface',
            'Keep\Repositories\Task\TaskRepositoryInterface',
            'Keep\Repositories\User\UserRepositoryInterface',
            'Keep\Repositories\Priority\PriorityRepositoryInterface',
            'Keep\Repositories\UserGroup\UserGroupRepositoryInterface',
            'Keep\Repositories\Assignment\AssignmentRepositoryInterface',
            'Keep\Repositories\Notification\NotificationRepositoryInterface'
        ];
    }
}
