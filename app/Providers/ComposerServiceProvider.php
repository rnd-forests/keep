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
        $this->composeNavbar();
        $this->composeAllViews();
        $this->composeTaskForm();
        $this->composeAssignmentForm();
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
     * Compose main navigation bar.
     */
    protected function composeNavbar()
    {
        view()->composer(
            'layouts.partials._main_navbar',
            \Keep\Http\Composers\MainNavigationBar::class
        );
    }

    /**
     * Compose main task create/update form.
     */
    protected function composeTaskForm()
    {
        view()->composer(
            [
                'admin.assignments.edit',
                'users.tasks.partials._main_form',
                'admin.assignments.create_group_assignment',
                'admin.assignments.create_member_assignment',
            ],
            \Keep\Http\Composers\TaskForm::class
        );
    }

    /**
     * Compose main assignment create/update form.
     */
    protected function composeAssignmentForm()
    {
        view()->composer(
            [
                'admin.assignments.edit',
                'admin.assignments.create_group_assignment',
            ],
            \Keep\Http\Composers\GroupAssignmentForm::class
        );

        view()->composer(
            [
                'admin.assignments.edit',
                'admin.assignments.create_member_assignment',
            ],
            \Keep\Http\Composers\MemberAssignmentForm::class
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
