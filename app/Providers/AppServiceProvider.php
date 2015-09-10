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
        $this->registerUserMailer();
    }

    /**
     * Set different configurations for different application environments.
     */
    protected function configureApplicationEnvironments()
    {
        switch ($this->app->environment()) {
            case 'production':
                config(['database.connections.pgsql.host' => parse_url(env('DATABASE_URL'))['host']]);
                config(['database.connections.pgsql.database' => substr(parse_url(env('DATABASE_URL'))['path'], 1)]);
                config(['database.connections.pgsql.username' => parse_url(env('DATABASE_URL'))['user']]);
                config(['database.connections.pgsql.password' => parse_url(env('DATABASE_URL'))['pass']]);
                break;
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
     * Register Mailer binding.
     */
    protected function registerUserMailer()
    {
        $this->app->singleton(
            \Keep\Mailers\Contracts\UserMailerContract::class,
            \Keep\Mailers\UserMailer::class
        );
    }
}
