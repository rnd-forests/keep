<?php namespace Keep\Providers;

use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->composeTaskForm();
        $this->composeAssignmentForm();
        $this->composeUserDashboard();
        $this->composeNotificationForm();
    }

    private function composeTaskForm()
    {
        view()->composer(
            'users.tasks.partials.form',
            'Keep\Http\Composers\TaskFormComposer@compose'
        );
        view()->composer(
            'admin.assignments.edit',
            'Keep\Http\Composers\TaskFormComposer@compose'
        );
        view()->composer(
            'admin.assignments.create_group_assignment',
            'Keep\Http\Composers\TaskFormComposer@compose'
        );
        view()->composer(
            'admin.assignments.create_member_assignment',
            'Keep\Http\Composers\TaskFormComposer@compose'
        );
    }

    private function composeAssignmentForm()
    {
        view()->composer(
            'admin.assignments.edit',
            'Keep\Http\Composers\EditAssignmentFormComposer@compose'
        );

        view()->composer(
            'admin.assignments.create_group_assignment',
            'Keep\Http\Composers\CreateGroupAssignmentFormComposer@compose'
        );

        view()->composer(
            'admin.assignments.create_member_assignment',
            'Keep\Http\Composers\CreateMemberAssignmentFormComposer@compose'
        );
    }

    private function composeUserDashboard()
    {
        view()->composer(
            'users.dashboard.dashboard',
            'Keep\Http\Composers\UserDashboardComposer@compose'
        );
    }

    private function composeNotificationForm()
    {
        view()->composer(
            'admin.notifications.partials.form',
            'Keep\Http\Composers\NotificationFormComposer@compose'
        );

        view()->composer(
            'admin.notifications.create_member_notification',
            'Keep\Http\Composers\CreateMemberNotificationFormComposer'
        );

        view()->composer(
            'admin.notifications.create_group_notification',
            'Keep\Http\Composers\CreateGroupNotificationFormComposer'
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
