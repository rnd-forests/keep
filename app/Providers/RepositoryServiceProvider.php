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
            \Keep\Repositories\Contracts\TagRepository::class,
            \Keep\Repositories\EloquentTagRepository::class
        );

        $this->app->singleton(
            \Keep\Repositories\Contracts\TaskRepository::class,
            \Keep\Repositories\EloquentTaskRepository::class
        );

        $this->app->singleton(
            \Keep\Repositories\Contracts\UserRepository::class,
            \Keep\Repositories\EloquentUserRepository::class
        );

        $this->app->singleton(
            \Keep\Repositories\Contracts\GroupRepository::class,
            \Keep\Repositories\EloquentGroupRepository::class
        );

        $this->app->singleton(
            \Keep\Repositories\Contracts\PriorityRepository::class,
            \Keep\Repositories\EloquentPriorityRepository::class
        );

        $this->app->singleton(
            \Keep\Repositories\Contracts\NotificationRepository::class,
            \Keep\Repositories\EloquentNotificationRepository::class
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
            \Keep\Repositories\Contracts\TagRepository::class,
            \Keep\Repositories\Contracts\TaskRepository::class,
            \Keep\Repositories\Contracts\UserRepository::class,
            \Keep\Repositories\Contracts\GroupRepository::class,
            \Keep\Repositories\Contracts\PriorityRepository::class,
            \Keep\Repositories\Contracts\NotificationRepository::class,
        ];
    }
}
