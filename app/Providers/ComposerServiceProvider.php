<?php
namespace Keep\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            return $view->with('authUser', auth()->user());
        });

        $this->composeNavbar();
        $this->composeTaskForm();
        $this->composeAssignmentForm();
        $this->composeNotificationForm();
    }

    private function composeNavbar()
    {
        view()->composer(
            'layouts.partials._main_navbar',
            'Keep\Http\ViewComposers\MainNavigationBar'
        );
    }

    private function composeTaskForm()
    {
        view()->composer(
            [
                'admin.assignments.edit',
                'users.tasks.partials._main_form',
                'admin.assignments.create_group_assignment',
                'admin.assignments.create_member_assignment',
            ],
            'Keep\Http\ViewComposers\TaskForm'
        );
    }

    private function composeAssignmentForm()
    {
        view()->composer(
            [
                'admin.assignments.edit',
                'admin.assignments.create_group_assignment'
            ],
            'Keep\Http\ViewComposers\GroupAssignmentForm'
        );

        view()->composer(
            [
                'admin.assignments.edit',
                'admin.assignments.create_member_assignment'
            ],
            'Keep\Http\ViewComposers\MemberAssignmentForm'
        );
    }

    private function composeNotificationForm()
    {
        view()->composer(
            'admin.notifications.create_member_notification',
            'Keep\Http\ViewComposers\MemberNotificationForm'
        );

        view()->composer(
            'admin.notifications.create_group_notification',
            'Keep\Http\ViewComposers\GroupNotificationForm'
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
