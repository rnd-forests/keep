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
            \Keep\Repositories\User\UserRepositoryInterface::class,
            \Keep\Repositories\User\EloquentUserRepository::class
        );

        $this->app->bind(
            \Keep\Repositories\Tag\TagRepositoryInterface::class,
            \Keep\Repositories\Tag\EloquentTagRepository::class
        );

        $this->app->bind(
            \Keep\Repositories\Task\TaskRepositoryInterface::class,
            \Keep\Repositories\Task\EloquentTaskRepository::class
        );

        $this->app->bind(
            \Keep\Repositories\Priority\PriorityRepositoryInterface::class,
            \Keep\Repositories\Priority\EloquentPriorityRepository::class
        );

        $this->app->bind(
            \Keep\Repositories\UserGroup\UserGroupRepositoryInterface::class,
            \Keep\Repositories\UserGroup\EloquentUserGroupRepository::class
        );

        $this->app->bind(
            \Keep\Repositories\Assignment\AssignmentRepositoryInterface::class,
            \Keep\Repositories\Assignment\EloquentAssignmentRepository::class
        );

        $this->app->bind(
            \Keep\Repositories\Notification\NotificationRepositoryInterface::class,
            \Keep\Repositories\Notification\EloquentNotificationRepository::class
        );

        if ($this->app->environment() == 'local') {
            $this->app->register('Laracasts\Generators\GeneratorsServiceProvider');
        }
    }
}
