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
    }

    /**
     * Composer task form view.
     */
    private function composeTaskForm()
    {
        view()->composer('tasks.partials.form', 'Keep\Http\Composers\TaskFormComposer@compose');
        view()->composer('admin.assignments.partials.member_assignment_form', 'Keep\Http\Composers\TaskFormComposer@compose');
        view()->composer('admin.assignments.partials.group_assignment_form', 'Keep\Http\Composers\TaskFormComposer@compose');
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
