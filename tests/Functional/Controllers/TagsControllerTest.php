<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class TagsControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected $mock, $user;

    /**
     * @before
     */
    public function it_initializes_testing_environment()
    {
        $this->mock = $this->mock('Keep\Repositories\Tag\TagRepositoryInterface');
        $this->user = factory('Keep\Entities\User')->create();
        $this->actingAs($this->user);
    }

    /** @test */
    public function it_fetches_all_tags_associated_with_a_user()
    {
        $this->mock->shouldReceive('fetchAttachedTags')->with($this->user->slug)->once()->andReturn(collect([]));
        $this->route('GET', 'member::tags.all', ['users' => $this->user->slug]);

        $this->assertResponseOk();
        $this->assertViewIs('users.tags.index');
        $this->assertViewHas('tags', collect([]));
    }

    /** @test */
    public function it_fetches_all_tasks_of_a_user_associated_with_a_tag()
    {
        $paginator = $this->mockPaginator();
        $tag = factory('Keep\Entities\Tag')->create(['name' => 'personal']);
        $this->mock->shouldReceive('findBySlug')->with('personal')->once()->andReturn($tag);
        $this->mock->shouldReceive('fetchTasksAssociatedWithTag')->with($this->user->slug, 'personal', 10)->once()->andReturn($paginator);
        $this->route('GET', 'member::tags.task', ['users' => $this->user->slug, 'tags' => 'personal']);

        $this->assertResponseOk();
        $this->assertViewIs('users.tags.show');
        $this->assertViewHasAll(['tag' => $tag, 'tasks' => $paginator]);
    }
}
