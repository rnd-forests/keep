<?php

use Illuminate\Foundation\Testing\TestCase as LaravelTestCase;

class TestCase extends LaravelTestCase
{
    use EloquentRelationsTrait, AdditionalHelpersTrait, AdditionalAssertionsTrait;

    protected $baseUrl = 'http://keep.app';

    public function createApplication()
    {
        $app = require __DIR__ . '/../bootstrap/app.php';
        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }
}
