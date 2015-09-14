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
            \Keep\Repositories\Contracts\TagRepositoryInterface::class,
            \Keep\Repositories\EloquentTagRepository::class
        );

        $this->app->singleton(
            \Keep\Repositories\Contracts\TaskRepositoryInterface::class,
            \Keep\Repositories\EloquentTaskRepository::class
        );

        $this->app->singleton(
            \Keep\Repositories\Contracts\UserRepositoryInterface::class,
            \Keep\Repositories\EloquentUserRepository::class
        );

        $this->app->singleton(
            \Keep\Repositories\Contracts\GroupRepositoryInterface::class,
            \Keep\Repositories\EloquentGroupRepository::class
        );

        $this->app->singleton(
            \Keep\Repositories\Contracts\PriorityRepositoryInterface::class,
            \Keep\Repositories\EloquentPriorityRepository::class
        );

        $this->app->singleton(
            \Keep\Repositories\Contracts\NotificationRepositoryInterface::class,
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
            \Keep\Repositories\Contracts\TagRepositoryInterface::class,
            \Keep\Repositories\Contracts\TaskRepositoryInterface::class,
            \Keep\Repositories\Contracts\UserRepositoryInterface::class,
            \Keep\Repositories\Contracts\GroupRepositoryInterface::class,
            \Keep\Repositories\Contracts\PriorityRepositoryInterface::class,
            \Keep\Repositories\Contracts\NotificationRepositoryInterface::class,
        ];
    }
}
