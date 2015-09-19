<?php

use Illuminate\Foundation\Testing\TestCase as LaravelTestCase;

class TestCase extends LaravelTestCase
{
    use EloquentRelationsTrait, AdditionalHelpersTrait, AdditionalAssertionsTrait;

    /**
     * Application base URL.
     *
     * @var string
     */
    protected $baseUrl = 'http://keep.app';

    /**
     * Create a new instance of the application.
     *
     * @return mixed
     */
    public function createApplication()
    {
        $app = require __DIR__ . '/../bootstrap/app.php';
        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }
}
