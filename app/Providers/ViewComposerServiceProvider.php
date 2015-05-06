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
        $this->composeEditAssignmentForm();
        $this->composeGroupAssignmentForm();
        $this->composeMemberAssignmentForm();
    }

    private function composeTaskForm()
    {
        view()->composer('users.tasks.partials.form', 'Keep\Http\Composers\TaskFormComposer@compose');
        view()->composer('admin.assignments.edit', 'Keep\Http\Composers\TaskFormComposer@compose');
        view()->composer('admin.assignments.create_group_assignment', 'Keep\Http\Composers\TaskFormComposer@compose');
        view()->composer('admin.assignments.create_member_assignment', 'Keep\Http\Composers\TaskFormComposer@compose');
    }

    private function composeEditAssignmentForm()
    {
        view()->composer('admin.assignments.edit', 'Keep\Http\Composers\EditAssignmentFormComposer@compose');
    }

    private function composeGroupAssignmentForm()
    {
        view()->composer('admin.assignments.create_group_assignment', 'Keep\Http\Composers\CreateGroupAssignmentFormComposer@compose');
    }

    private function composeMemberAssignmentForm()
    {
        view()->composer('admin.assignments.create_member_assignment', 'Keep\Http\Composers\CreateMemberAssignmentFormComposer@compose');
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
