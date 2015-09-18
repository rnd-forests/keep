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
            \Keep\Core\Search\Contracts\SearchContract::class,
            \Keep\Core\Search\EloquentSearch::class
        );
    }

    /**
     * Register Search service container binding (Search facade).
     */
    protected function registerSearchServiceContainerBinding()
    {
        $this->app->singleton('search', \Keep\Core\Search\Contracts\SearchContract::class);
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
            \Keep\Core\Search\Contracts\SearchContract::class,
        ];
    }
}
