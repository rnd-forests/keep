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
        $this->repo = app('Keep\Repositories\Tag\EloquentTagRepository');
    }

    /** @test */
    public function it_lists_all_tags_by_name_and_id()
    {
        factory('Keep\Entities\Tag')->create(['name' => 'foo']);
        factory('Keep\Entities\Tag')->create(['name' => 'bar']);
        factory('Keep\Entities\Tag')->create(['name' => 'baz']);

        $tags = $this->repo->lists();

        $this->assertCount(3, $tags);
        $this->assertEquals('foo', $tags->toArray()[1]);
        $this->assertEquals('bar', $tags->toArray()[2]);
        $this->assertEquals('baz', $tags->toArray()[3]);
        $this->assertEquals(['bar', 'baz', 'foo'], array_flatten($tags->toArray()));
    }

    /** @test */
    public function it_fetches_all_tags_associated_with_a_user()
    {
        $user = factory('Keep\Entities\User')->create();
        $user->tasks()->saveMany(factory('Keep\Entities\Task', 2)->create());
        factory('Keep\Entities\Tag')->create(['name' => 'foo']);
        factory('Keep\Entities\Tag')->create(['name' => 'bar']);
        factory('Keep\Entities\Tag')->create(['name' => 'baz']);
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
        $user = factory('Keep\Entities\User')->create();
        $user->tasks()->save(factory('Keep\Entities\Task')->create(['title' => 'Egg']));
        $user->tasks()->save(factory('Keep\Entities\Task')->create(['title' => 'Chicken']));
        factory('Keep\Entities\Tag')->create(['name' => 'foo']);
        factory('Keep\Entities\Tag')->create(['name' => 'bar']);
        $user->tasks->first()->tags()->attach([1, 2]);
        $user->tasks->last()->tags()->attach(2);

        $foos = $this->repo->fetchTasksAssociatedWithTag($user->slug, 'foo', 2);
        $bars = $this->repo->fetchTasksAssociatedWithTag($user->slug, 'bar', 2);
        $limitedBars = $this->repo->fetchTasksAssociatedWithTag($user->slug, 'bar', 1);

        $this->assertCount(1, $foos);
        $this->assertCount(2, $bars);
        $this->assertCount(1, $limitedBars);
        $this->assertEquals(2, $limitedBars->total());
        $this->assertEquals('Egg', $foos->toArray()['data'][0]['title']);
    }
}
