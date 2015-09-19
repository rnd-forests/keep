<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class EloquentTagRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    protected $repo;

    /**
     * @before
     */
    public function it_initializes_the_repository()
    {
        $this->repo = app(Keep\Repositories\EloquentTagRepository::class);
    }

    /** @test */
    public function it_lists_all_tags_by_name_and_id()
    {
        factory(Keep\Entities\Tag::class)->create(['name' => 'foo']);
        factory(Keep\Entities\Tag::class)->create(['name' => 'bar']);
        factory(Keep\Entities\Tag::class)->create(['name' => 'baz']);

        $tags = $this->repo->lists()->toArray();

        $this->assertCount(3, $tags);
        $this->assertEquals([1 => 'foo', 2 => 'bar', 3 => 'baz'], $tags);
        $this->assertEquals(['bar', 'baz', 'foo'], array_flatten($tags));
    }

    /** @test */
    public function it_fetches_all_tags_associated_with_a_user()
    {
        $user = factory(Keep\Entities\User::class)->create();
        $user->tasks()->saveMany(factory(Keep\Entities\Task::class, 2)->create());
        factory(Keep\Entities\Tag::class)->create(['name' => 'foo']);
        factory(Keep\Entities\Tag::class)->create(['name' => 'bar']);
        $user->tasks->first()->tags()->attach([1, 2]);
        $user->tasks->last()->tags()->attach(2);

        $tags = $this->repo->fetchAttachedTags($user->slug);

        $this->assertCount(2, $tags);
        $this->assertEquals('bar', $tags->first()->name);
        $this->assertEquals('foo', $tags->last()->name);
        $this->assertCount(2, $tags->first()->tasks);
        $this->assertCount(1, $tags->last()->tasks);
    }

    /** @test */
    public function it_fetches_all_tasks_associated_with_a_user_tag()
    {
        $user = factory(Keep\Entities\User::class)->create();
        $user->tasks()->saveMany(factory(Keep\Entities\Task::class, 2)->create());
        factory(Keep\Entities\Tag::class)->create(['name' => 'foo']);
        factory(Keep\Entities\Tag::class)->create(['name' => 'bar']);
        $user->tasks->first()->tags()->attach([1, 2]);
        $user->tasks->last()->tags()->attach(2);

        $foos = $this->repo->associatedTasks($user->slug, 'foo', 2);
        $bars = $this->repo->associatedTasks($user->slug, 'bar', 2);
        $limited = $this->repo->associatedTasks($user->slug, 'bar', 1);

        $this->assertCount(1, $foos);
        $this->assertCount(2, $bars);
        $this->assertCount(1, $limited);
        $this->assertEquals(2, $limited->total());
    }
}
