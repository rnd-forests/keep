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
            \Keep\Repositories\Tag\TagRepositoryInterface::class,
            \Keep\Repositories\Tag\EloquentTagRepository::class
        );

        $this->app->singleton(
            \Keep\Repositories\Task\TaskRepositoryInterface::class,
            \Keep\Repositories\Task\EloquentTaskRepository::class
        );

        $this->app->singleton(
            \Keep\Repositories\User\UserRepositoryInterface::class,
            \Keep\Repositories\User\EloquentUserRepository::class
        );

        $this->app->singleton(
            \Keep\Repositories\Priority\PriorityRepositoryInterface::class,
            \Keep\Repositories\Priority\EloquentPriorityRepository::class
        );

        $this->app->singleton(
            \Keep\Repositories\UserGroup\UserGroupRepositoryInterface::class,
            \Keep\Repositories\UserGroup\EloquentUserGroupRepository::class
        );

        $this->app->singleton(
            \Keep\Repositories\Assignment\AssignmentRepositoryInterface::class,
            \Keep\Repositories\Assignment\EloquentAssignmentRepository::class
        );

        $this->app->singleton(
            \Keep\Repositories\Notification\NotificationRepositoryInterface::class,
            \Keep\Repositories\Notification\EloquentNotificationRepository::class
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
            \Keep\Repositories\Tag\TagRepositoryInterface::class,
            \Keep\Repositories\Task\TaskRepositoryInterface::class,
            \Keep\Repositories\User\UserRepositoryInterface::class,
            \Keep\Repositories\Priority\PriorityRepositoryInterface::class,
            \Keep\Repositories\UserGroup\UserGroupRepositoryInterface::class,
            \Keep\Repositories\Assignment\AssignmentRepositoryInterface::class,
            \Keep\Repositories\Notification\NotificationRepositoryInterface::class,
        ];
    }
}
