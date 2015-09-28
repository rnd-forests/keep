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
            \Keep\Core\Repository\Contracts\TagRepository::class,
            \Keep\Core\Repository\EloquentTagRepository::class
        );

        $this->app->singleton(
            \Keep\Core\Repository\Contracts\TaskRepository::class,
            \Keep\Core\Repository\EloquentTaskRepository::class
        );

        $this->app->singleton(
            \Keep\Core\Repository\Contracts\UserRepository::class,
            \Keep\Core\Repository\EloquentUserRepository::class
        );

        $this->app->singleton(
            \Keep\Core\Repository\Contracts\GroupRepository::class,
            \Keep\Core\Repository\EloquentGroupRepository::class
        );

        $this->app->singleton(
            \Keep\Core\Repository\Contracts\PriorityRepository::class,
            \Keep\Core\Repository\EloquentPriorityRepository::class
        );

        $this->app->singleton(
            \Keep\Core\Repository\Contracts\NotificationRepository::class,
            \Keep\Core\Repository\EloquentNotificationRepository::class
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
            \Keep\Core\Repository\Contracts\TagRepository::class,
            \Keep\Core\Repository\Contracts\TaskRepository::class,
            \Keep\Core\Repository\Contracts\UserRepository::class,
            \Keep\Core\Repository\Contracts\GroupRepository::class,
            \Keep\Core\Repository\Contracts\PriorityRepository::class,
            \Keep\Core\Repository\Contracts\NotificationRepository::class,
        ];
    }
}
