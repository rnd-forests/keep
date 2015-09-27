<?php

namespace Keep\Providers;

use Keep\Core\Mailers\UserMailer;
use Illuminate\Support\ServiceProvider;
use Keep\Core\Mailers\Contracts\UserMailerContract;

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
                $this->configurePgsql();
                break;
            case 'local':
                $this->logDatabaseQueries();
                $this->configureMailtrap();
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
            UserMailerContract::class,
            UserMailer::class
        );
    }

    /**
     * Log database queries for local development.
     */
    protected function logDatabaseQueries()
    {
        $logger = $this->app->make('log');
        $this->app->make('db')->listen(function ($sql, $bindings, $time) use ($logger) {
            $logger->info($time);
            $logger->info($sql);
            $logger->info($bindings);
        });
    }

    /**
     * Configure PostgreSQL for production.
     */
    protected function configurePgsql()
    {
        config(['database.connections.pgsql.host' => parse_url(env('DATABASE_URL'))['host']]);
        config(['database.connections.pgsql.database' => substr(parse_url(env('DATABASE_URL'))['path'], 1)]);
        config(['database.connections.pgsql.username' => parse_url(env('DATABASE_URL'))['user']]);
        config(['database.connections.pgsql.password' => parse_url(env('DATABASE_URL'))['pass']]);
    }

    /**
     * Configure Mailtrap for testing emails sent from application.
     */
    protected function configureMailtrap()
    {
        config(['mail.driver' => 'smtp']);
        config(['mail.host' => 'mailtrap.io']);
        config(['mail.port' => '2525']);
        config(['mail.username' => env('MAILTRAP_USERNAME')]);
        config(['mail.password' => env('MAILTRAP_PASSWORD')]);
    }
}
