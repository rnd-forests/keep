<?php

namespace Keep\Providers;

use DB;
use Log;
use Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $this->configureEnvironments();

        Validator::extend('alpha_spaces', function ($attribute, $value, $parameters) {
            return preg_match('/^[\pL\s]+$/u', $value);
        });
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
        $this->app->singleton(
            \Keep\Repositories\User\UserRepositoryInterface::class,
            \Keep\Repositories\User\EloquentUserRepository::class
        );

        $this->app->singleton(
            \Keep\Repositories\Tag\TagRepositoryInterface::class,
            \Keep\Repositories\Tag\EloquentTagRepository::class
        );

        $this->app->singleton(
            \Keep\Repositories\Task\TaskRepositoryInterface::class,
            \Keep\Repositories\Task\EloquentTaskRepository::class
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

        if ($this->app->environment() == 'local') {
            $this->app->register(\Laracasts\Generators\GeneratorsServiceProvider::class);
        }
    }

    /**
     * Set different configurations for different application environments.
     */
    private function configureEnvironments()
    {
        switch ($this->app->environment()) {
            case 'local':
                DB::listen(function ($sql, $bindings, $time) {
                    Log::info($time);
                    Log::info($sql);
                    Log::info($bindings);
                });
                break;
            case 'testing':
                config(['database.default' => 'sqlite']);
                break;
            case 'acceptance':
                config(['database.default' => 'sqlite']);
                config(['database.connections.sqlite.database' => storage_path() . '/acceptance.sqlite']);
                break;
            default:
                break;
        }
    }
}
