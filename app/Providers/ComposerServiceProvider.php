<?php

namespace Keep\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->composeAllViews();
        $this->composeTaskForm();
        $this->composeNotificationForm();
    }

    /**
     * All views will receive an instance of the current authenticated user.
     */
    protected function composeAllViews()
    {
        view()->composer('*', function ($view) {
            return $view->with('authUser', auth()->user());
        });
    }

    /**
     * Compose main task create/update form.
     */
    protected function composeTaskForm()
    {
        view()->composer(
            'users.tasks.partials._main_form',
            \Keep\Http\Composers\TaskForm::class
        );
    }

    /**
     * Compose notification create from.
     */
    protected function composeNotificationForm()
    {
        view()->composer(
            'admin.notifications.create_member_notification',
            \Keep\Http\Composers\MemberNotificationForm::class
        );

        view()->composer(
            'admin.notifications.create_group_notification',
            \Keep\Http\Composers\GroupNotificationForm::class
        );
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        //
    }
}
