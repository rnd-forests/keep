<?php  namespace Keep\Providers; 

use Illuminate\Html\HtmlServiceProvider;

class MacroServiceProvider extends HtmlServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        parent::register();

        require base_path() . '/resources/macros/form_delete.php';
    }
}