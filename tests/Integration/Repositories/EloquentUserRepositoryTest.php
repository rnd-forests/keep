<?php

use Keep\Entities\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EloquentUserRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    protected $repo;

    /**
     * @before
     */
    public function it_initializes_the_repository()
    {
        $this->repo = app(Keep\Repositories\User\AbstractEloquentUserRepository::class);
    }

    /** @test */
    public function it_finds_a_user_by_activation_code_and_current_active_state()
    {
        $code = str_random(100);
        factory(Keep\Entities\User::class)->create(['name' => 'foo', 'activation_code' => $code, 'active' => false]);

        $user = $this->repo->findByActivationCode($code, false);

        $this->assertEquals('foo', $user->name);
        $this->assertEquals(false, $user->active);
        $this->assertEquals($code, $user->activation_code);
    }

    /** @test */
    public function it_creates_a_new_user_with_given_credentials()
    {
        $credentials = ['name' => 'foo', 'email' => 'foo@bar.com', 'password' => 'foobar'];

        $user = $this->repo->create($credentials);

        $this->assertEquals('foo', $user->name);
        $this->assertEquals(false, $user->active);
        $this->assertEquals('foo@bar.com', $user->email);
        $this->assertTrue(Hash::check('foobar', $user->password));
        $this->assertEquals(100, strlen($user->activation_code));
        $this->seeInDatabase('users', ['name' => 'foo', 'email' => 'foo@bar.com']);
    }

    /** @test */
    public function it_associates_new_user_with_a_empty_profile()
    {
        $user = factory(Keep\Entities\User::class)->create();
        $attributes = array_flatten(array_except($user->profile->toArray(), ['id', 'user_id', 'created_at', 'updated_at']));

        $this->assertContainsOnly('null', $attributes);
    }

    /** @test */
    public function it_updates_the_profile_of_an_existing_user()
    {
        $user = factory(Keep\Entities\User::class)->create();
        $attributes = ['location' => 'foo', 'bio' => 'foo foo'];

        $this->repo->updateProfile($attributes, $user->slug);

        $this->assertEquals('foo', $user->profile->location);
        $this->assertEquals('foo foo', $user->profile->bio);
    }

    /** @test */
    public function it_restores_a_soft_deleted_user()
    {
        $user = factory(Keep\Entities\User::class)->create(['name' => 'foo']);
        $user->delete();

        $this->assertTrue($user->trashed());

        $this->repo->restore('foo');

        $this->assertFalse(User::where('slug', 'foo')->first()->trashed());
    }

    /** @test */
    public function it_softly_deletes_a_user()
    {
        factory(Keep\Entities\User::class)->create(['name' => 'baz', 'email' => 'foo@baz.com']);

        $this->repo->softDelete('baz');

        $this->seeInDatabase('users', ['name' => 'baz', 'email' => 'foo@baz.com']);
    }

    /**
     * @test
     * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function it_throws_an_exception_when_trying_to_fetch_a_soft_deleted_user()
    {
        factory(Keep\Entities\User::class)->create(['name' => 'foo']);

        $this->repo->softDelete('foo');

        User::where('slug', 'foo')->firstOrFail();
    }

    /** @test */
    public function it_permanently_deletes_a_soft_deleted_user()
    {
        $user = factory(Keep\Entities\User::class)->create(['name' => 'foo', 'email' => 'foo@bar.com']);
        $user->tasks()->saveMany(factory(Keep\Entities\Task::class, 2)->create());
        $user->delete();

        $this->seeInDatabase('users', ['name' => 'foo', 'email' => 'foo@bar.com']);
        $this->seeInDatabase('profiles', ['user_id' => $user->id]);
        $this->seeInDatabase('tasks', ['user_id' => $user->id]);

        $this->repo->forceDelete('foo');

        $this->missingFromDatabase('users', ['name' => 'foo', 'email' => 'foo@bar.com']);
        $this->missingFromDatabase('profiles', ['user_id' => $user->id]);
        $this->missingFromDatabase('tasks', ['user_id' => $user->id]);
    }

    /** @test */
    public function it_fetches_a_paginated_list_of_soft_deleted_users()
    {
        factory(Keep\Entities\User::class)->create();
        factory(Keep\Entities\User::class)->create()->delete();
        factory(Keep\Entities\User::class)->create()->delete();
        factory(Keep\Entities\User::class)->create()->delete();

        $result = $this->repo->fetchDisabledUsers(2);

        $this->assertCount(2, $result);
        $this->assertEquals(3, $result->total());
    }

    /** @test */
    public function it_fetches_a_soft_deleted_user_by_slug()
    {
        factory(Keep\Entities\User::class)->create(['name' => 'bar', 'email' => 'foo@bar.com'])->delete();

        $user = $this->repo->findDisabledUserBySlug('bar');

        $this->assertTrue($user->trashed());
        $this->assertEquals('bar', $user->name);
        $this->assertEquals('foo@bar.com', $user->email);
    }

    /**
     * @test
     * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function it_throws_an_exception_when_trying_to_fetch_an_unavailable_soft_deleted_user()
    {
        $this->repo->findDisabledUserBySlug('bar');
    }

    /** @test */
    public function it_fetches_a_collection_of_users_given_an_array_of_ids()
    {
        DB::table('users')->truncate();
        factory(Keep\Entities\User::class, 4)->create();

        $users = $this->repo->fetchUsersByIds([1, 2, 3]);

        $this->assertCount(3, $users);
        $this->assertEquals([1, 2, 3], $users->lists('id')->toArray());
        $this->assertContainsOnlyInstancesOf(Keep\Entities\User::class, $users);
    }
}
