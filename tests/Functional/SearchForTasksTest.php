<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class SearchForTasksTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_searches_for_tasks_using_their_titles()
    {
        $user = factory(Keep\Entities\User::class)->create(['name' => 'anonymous']);
        $user->tasks()->save(factory(Keep\Entities\Task::class)->create(['title' => 'foo baz']));
        $user->tasks()->save(factory(Keep\Entities\Task::class)->create(['title' => 'foo bar']));
        $user->tasks()->save(factory(Keep\Entities\Task::class)->create(['title' => 'bar baz']));

        $this->actingAs($user);

        $this->visit('/')
            ->click('Dashboard')
            ->seePageIs('anonymous/dashboard')
            ->type('foo', 'q')
            ->press('')
            ->seePageIs('anonymous/search?q=foo')
            ->see('2 tasks found for')
            ->see('<strong class="text-danger">foo</strong>')
            ->see('foo baz')
            ->see('foo bar');
    }
}
