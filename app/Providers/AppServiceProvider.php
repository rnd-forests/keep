<?php

namespace Keep\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $this->configureApplicationEnvironments();
    }

    /**
     * Register any application services.
     *
     * This service provider is a great spot to register your various container
     * bindings with the application. As you can see, we are registering our
     * "Registrar" implementation here. You can add your own bindings too!
     */
    public function register()
    {
        $this->registerArtisanGenerator();
    }

    /**
     * Set different configurations for different application environments.
     */
    protected function configureApplicationEnvironments()
    {
        switch ($this->app->environment()) {
            case 'local':
                $logger = $this->app->make('log');
                $this->app->make('db')->listen(function ($sql, $bindings, $time) use ($logger) {
                    $logger->info($time);
                    $logger->info($sql);
                    $logger->info($bindings);
                });
                break;
            case 'testing':
                config(['database.default' => 'sqlite']);
                break;
        }
    }

    /**
     * Register artisan generator service provider for local development.
     */
    protected function registerArtisanGenerator()
    {
        if ($this->app->environment() == 'local') {
            $this->app->register(\Laracasts\Generators\GeneratorsServiceProvider::class);
        }
    }
}
