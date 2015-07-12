<?php

namespace Keep\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $this->configureEnvironments();
    }

    /**
     * Register any application services.
     *
     * This service provider is a great spot to register your various container
     * bindings with the application. As you can see, we are registering our
     * "Registrar" implementation here. You can add your own bindings too!
     */
    public function register()
    {
        $this->registerRepositoryBindings();
        $this->registerCustomServiceProviders();
    }

    /**
     * Set different configurations for different application environments.
     */
    private function configureEnvironments()
    {
        switch ($this->app->environment()) {
            case 'local':
                $logger = $this->app->make('log');
                $this->app->make('db')->listen(function ($sql, $bindings, $time) use ($logger) {
                    $logger->info($time);
                    $logger->info($sql);
                    $logger->info($bindings);
                });
                break;
            case 'testing':
                config(['database.default' => 'sqlite']);
                break;
        }
    }

    /**
     * Bind all repository interfaces to their concrete implementations.
     */
    private function registerRepositoryBindings()
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
     * Register all custom third-party service providers.
     */
    private function registerCustomServiceProviders()
    {
        if ($this->app->environment() == 'local') {
            $this->app->register(\Laracasts\Generators\GeneratorsServiceProvider::class);
        }
    }
}
