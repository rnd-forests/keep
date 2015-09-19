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
     * Compose task form.
     */
    protected function composeTaskForm()
    {
        view()->composer(
            'users.tasks.partials._main_form',
            \Keep\Core\Composers\TaskForm::class
        );
    }

    /**
     * Compose notification forms.
     */
    protected function composeNotificationForm()
    {
        view()->composer(
            [
                'admin.notifications.create_member_notification',
                'admin.notifications.create_group_notification'
            ],
            \Keep\Core\Composers\NotificationForm::class
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
