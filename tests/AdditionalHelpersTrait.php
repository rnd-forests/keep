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
        $paginator = $this->mock(Illuminate\Contracts\Pagination\LengthAwarePaginator::class);
        $paginator->shouldReceive('render')->once();

        return $paginator;
    }

    public function setAuthenticatedUser(array $attributes = [])
    {
        $user = factory(Keep\Entities\User::class)->create($attributes);
        $this->actingAs($user);

        return $user;
    }
}