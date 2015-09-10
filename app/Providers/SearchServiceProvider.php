<?php

namespace Keep\Providers;

use Illuminate\Support\ServiceProvider;

class SearchServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerSearchContract();
        $this->registerSearchServiceContainerBinding();
    }

    /**
     * Register Search contract.
     */
    protected function registerSearchContract()
    {
        $this->app->singleton(
            \Keep\Search\Contracts\SearchContract::class,
            \Keep\Search\EloquentSearch::class
        );
    }

    /**
     * Register Search service container binding (Search facade).
     */
    protected function registerSearchServiceContainerBinding()
    {
        $this->app->singleton('search', \Keep\Search\Contracts\SearchContract::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'search',
            \Keep\Search\Contracts\SearchContract::class
        ];
    }
}
