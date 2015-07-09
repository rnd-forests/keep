<?php

trait AdditionalHelpersTrait
{
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

    public function assertFlashedMessage()
    {
        $this->assertSessionHas('flash_notification.message');
    }
}