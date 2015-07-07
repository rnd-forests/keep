<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class TagsControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected $mock, $user;

    /**
     * @before
     */
    public function initializeEnv()
    {
        $this->mock = $this->mock('Keep\Repositories\Tag\TagRepositoryInterface');
        $this->user = factory('Keep\Entities\User')->create();
        $this->actingAs($this->user);
    }

    public function testIndex()
    {
        $this->mock->shouldReceive('fetchAttachedTags')->with($this->user->slug)->once()->andReturn(collect([]));

        $this->route('GET', 'member::tags.all', ['users' => $this->user->slug]);

        $this->assertResponseOk();
        $this->assertViewIs('users.tags.index');
        $this->assertViewHas('tags', collect([]));
    }

    public function testShow()
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
