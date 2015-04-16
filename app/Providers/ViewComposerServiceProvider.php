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

}
