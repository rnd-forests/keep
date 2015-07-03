<?php

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\TestCase as LaravelTestCase;

class TestCase extends LaravelTestCase
{
    protected $baseUrl = 'http://keep.app';

    public function createApplication()
    {
        $app = require __DIR__ . '/../bootstrap/app.php';
        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    public function mock($class)
    {
        $mock = Mockery::mock($class);
        $this->app->instance($class, $mock);

        return $mock;
    }

    public function mockPaginator()
    {
        $paginator = $this->mock('Illuminate\Contracts\Pagination\LengthAwarePaginator');
        $paginator->shouldReceive('render')->once();

        return $paginator;
    }

    public function assertViewIs($name)
    {
        $this->assertEquals($name, $this->response->original->getName());
    }

    public function assertKeyTranslated($key)
    {
        $this->assertSessionHas('flash_notification.message', trans($key));
    }
}
