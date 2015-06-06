<?php
namespace Keep\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * This service provider is a great spot to register your various container
     * bindings with the application. As you can see, we are registering our
     * "Registrar" implementation here. You can add your own bindings too!
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'Keep\Repositories\User\UserRepositoryInterface',
            'Keep\Repositories\User\EloquentUserRepository'
        );

        $this->app->bind(
            'Keep\Repositories\Tag\TagRepositoryInterface',
            'Keep\Repositories\Tag\EloquentTagRepository'
        );

        $this->app->bind(
            'Keep\Repositories\Task\TaskRepositoryInterface',
            'Keep\Repositories\Task\EloquentTaskRepository'
        );

        $this->app->bind(
            'Keep\Repositories\Priority\PriorityRepositoryInterface',
            'Keep\Repositories\Priority\EloquentPriorityRepository'
        );

        $this->app->bind(
            'Keep\Repositories\UserGroup\UserGroupRepositoryInterface',
            'Keep\Repositories\UserGroup\EloquentUserGroupRepository'
        );

        $this->app->bind(
            'Keep\Repositories\Assignment\AssignmentRepositoryInterface',
            'Keep\Repositories\Assignment\EloquentAssignmentRepository'
        );

        $this->app->bind(
            'Keep\Repositories\Notification\NotificationRepositoryInterface',
            'Keep\Repositories\Notification\EloquentNotificationRepository'
        );

        if ($this->app->environment() == 'local') {
            $this->app->register('Laracasts\Generators\GeneratorsServiceProvider');
        }
    }
}
