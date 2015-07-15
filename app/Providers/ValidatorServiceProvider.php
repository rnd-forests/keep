<?php

namespace Keep\Providers;

use Illuminate\Support\ServiceProvider;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->onlyAlphabeticalCharactersAndSpacesRule();
    }

    /**
     * Validate that given pattern contains only alphabetical characters and spaces.
     */
    protected function onlyAlphabeticalCharactersAndSpacesRule()
    {
        $this->app->make('validator')->extend('alpha_spaces', function ($attribute, $value, $parameters) {
            return preg_match('/^[\pL\s]+$/u', $value);
        });
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
