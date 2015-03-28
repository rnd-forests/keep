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
        $this->composeAdminPanel();
        $this->composeAdminPanelNav();
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
     * Composer admin panel view.
     */
    private function composeAdminPanel()
    {
        view()->composer('admin.dashboard', 'Keep\Http\Composers\AdminPanelComposer@compose');
        view()->composer('admin.manage_users', 'Keep\Http\Composers\AdminPanelComposer@compose');
    }

    /**
     * Composer admin panel navigation view.
     */
    private function composeAdminPanelNav()
    {
        view()->composer('admin.partials.sidebar', 'Keep\Http\Composers\AdminPanelNavComposer@compose');
    }

}
