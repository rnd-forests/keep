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
        $this->composeAdminPanelTasks();
        $this->composeAdminSidebar();
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

    /**
     * Composer task form view.
     */
    private function composeTaskForm()
    {
        view()->composer('tasks.partials.form', 'Keep\Http\Composers\TaskFormComposer@compose');
    }

    /**
     * Composer admin panel task views.
     */
    private function composeAdminPanelTasks()
    {
        view()->composer('admin.manage_tasks', 'Keep\Http\Composers\AdminPanelTaskComposer@compose');
    }

    /**
     * Composer admin panel sidebar view.
     */
    private function composeAdminSidebar()
    {
        view()->composer('admin.partials.nav', 'Keep\Http\Composers\AdminSidebarComposer@compose');
    }

}
