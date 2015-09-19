<?php

trait AdditionalHelpersTrait
{
    /**
     * Mocking class helper function.
     *
     * @param $class
     * @return \Mockery\MockInterface
     */
    public function mock($class)
    {
        $mock = Mockery::mock($class);
        $this->app->instance($class, $mock);

        return $mock;
    }

    /**
     * Mocking the paginator class.
     *
     * @return \Mockery\MockInterface
     */
    public function mockPaginator()
    {
        $paginator = $this->mock(Illuminate\Contracts\Pagination\LengthAwarePaginator::class);
        $paginator->shouldReceive('render')->once();

        return $paginator;
    }

    /**
     * Set the current authenticated user instance.
     *
     * @param array $attributes
     * @return mixed
     */
    public function setAuthenticatedUser(array $attributes = [])
    {
        $user = factory(Keep\Entities\User::class)->create($attributes);
        $this->actingAs($user);

        return $user;
    }
}
